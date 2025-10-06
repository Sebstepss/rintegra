import { ref } from 'vue'
import { useMediaStore } from '@/stores/media'
import { buildMediaUrl, getMediaDisplayName as getDisplayName } from '@/utils/mediaUtils'

export interface MediaPickerOptions {
  typeFilter?: 'image' | 'video' | 'document'
  multiple?: boolean
  onSelect: (media: any | any[]) => void
}

export function useMediaPicker() {
  const mediaStore = useMediaStore()
  const showMediaPicker = ref(false)
  const selectedMedia = ref<any[]>([])
  const currentOptions = ref<MediaPickerOptions | null>(null)

  const openMediaPicker = (options: MediaPickerOptions) => {
    currentOptions.value = options
    selectedMedia.value = []
    showMediaPicker.value = true
  }

  const selectMedia = (media: any | any[]) => {
    // Handle array from MediaPicker component
    if (Array.isArray(media)) {
      selectedMedia.value = media
      return
    }

    // Handle single media selection
    if (currentOptions.value?.multiple) {
      const index = selectedMedia.value.findIndex(m => m.id === media.id)
      if (index > -1) {
        selectedMedia.value.splice(index, 1)
      } else {
        selectedMedia.value.push(media)
      }
    } else {
      selectedMedia.value = [media]
    }
  }

  const confirmSelection = () => {
    if (currentOptions.value?.onSelect && selectedMedia.value.length > 0) {
      const result = currentOptions.value.multiple 
        ? selectedMedia.value 
        : selectedMedia.value[0]
      currentOptions.value.onSelect(result)
    }
    closeMediaPicker()
  }

  const closeMediaPicker = () => {
    showMediaPicker.value = false
    selectedMedia.value = []
    currentOptions.value = null
  }

  const getFullMediaUrl = (media: any) => {
    if (!media || !media.url) return ''
    
    const fullUrl = buildMediaUrl(media.url)
    
    // Log para debug
    console.group('🔗 useMediaPicker - URL Generation')
    console.log('Original URL:', media.url)
    console.log('Final URL:', fullUrl)
    console.groupEnd()
    
    return fullUrl
  }

  const getMediaDisplayName = (media: any) => {
    return getDisplayName(media)
  }

  return {
    showMediaPicker,
    selectedMedia,
    currentOptions,
    openMediaPicker,
    selectMedia,
    confirmSelection,
    closeMediaPicker,
    getFullMediaUrl,
    getMediaDisplayName,
    mediaStore
  }
}