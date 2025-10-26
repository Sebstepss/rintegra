import { defineStore } from 'pinia'
import { pagesApi, contentsApi } from '@/services/api'

interface Content {
  id: number
  page_id: number
  content_type: string
  content_data: any
  order: number
  created_at: string
  updated_at: string
}

interface Page {
  id: number
  title: string
  slug: string
  meta_description: string | null
  status: 'draft' | 'published'
  created_at: string
  updated_at: string
  contents?: Content[]
}

export const useContentStore = defineStore('content', {
  state: () => ({
    pages: [] as Page[],
    currentPage: null as Page | null,
    loading: false,
    error: null as string | null
  }),

  actions: {
    async fetchPages() {
      this.loading = true
      try {
        const response = await pagesApi.getAll()
        this.pages = response.data
      } catch (error: any) {
        this.error = error.message
      } finally {
        this.loading = false
      }
    },

    async fetchPageBySlug(slug: string) {
      this.loading = true
      try {
        const response = await pagesApi.getBySlug(slug)
        this.currentPage = response.data
      } catch (error: any) {
        this.error = error.message
      } finally {
        this.loading = false
      }
    },

    async createPage(pageData: Partial<Page>) {
      try {
        const response = await pagesApi.create(pageData)
        this.pages.push(response.data)
        return response.data
      } catch (error: any) {
        this.error = error.message
        throw error
      }
    },

    async updatePage(id: number, pageData: Partial<Page>) {
      try {
        const response = await pagesApi.update(id, pageData)
        const index = this.pages.findIndex(p => p.id === id)
        if (index !== -1) {
          this.pages[index] = response.data
        }
        if (this.currentPage && this.currentPage.id === id) {
          this.currentPage = response.data
        }
        return response.data
      } catch (error: any) {
        this.error = error.message
        throw error
      }
    },

    async deletePage(id: number) {
      try {
        await pagesApi.delete(id)
        this.pages = this.pages.filter(p => p.id !== id)
        if (this.currentPage && this.currentPage.id === id) {
          this.currentPage = null
        }
      } catch (error: any) {
        this.error = error.message
        throw error
      }
    },

    async createContent(contentData) {
      try {
        const response = await contentsApi.create(contentData)
        if (this.currentPage && this.currentPage.id === contentData.page_id) {
          this.currentPage.contents.push(response.data)
        }
        return response.data
      } catch (error: any) {
        this.error = error.message
        throw error
      }
    },

    async updateContent(id, contentData) {
      try {
        const response = await contentsApi.update(id, contentData)
        if (this.currentPage) {
          const index = this.currentPage.contents.findIndex(c => c.id === id)
          if (index !== -1) {
            this.currentPage.contents[index] = response.data
          }
        }
        return response.data
      } catch (error: any) {
        this.error = error.message
        throw error
      }
    },

    async deleteContent(id) {
      try {
        await contentsApi.delete(id)
        if (this.currentPage) {
          this.currentPage.contents = this.currentPage.contents.filter(c => c.id !== id)
        }
      } catch (error: any) {
        this.error = error.message
        throw error
      }
    },

    async updateContentOrder(contents) {
      try {
        await contentsApi.updateOrder({ contents })
        if (this.currentPage) {
          this.currentPage.contents.sort((a, b) => a.order - b.order)
        }
      } catch (error: any) {
        this.error = error.message
        throw error
      }
    }
  }
})