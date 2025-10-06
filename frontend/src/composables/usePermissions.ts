import { computed } from 'vue'
import { useAuthStore } from '@/stores/auth'

export function usePermissions() {
  const authStore = useAuthStore()

  const hasPermission = (permission: string): boolean => {
    if (!authStore.user || !authStore.user.role) {
      console.log('No user or role found, denying permission:', permission)
      return false
    }

    // Admin siempre tiene todos los permisos
    if (authStore.user.role.name === 'admin') {
      console.log('Admin user, granting permission:', permission)
      return true
    }

    const hasPermissionResult = authStore.user.role.permissions?.includes(permission) || false
    console.log('Permission check:', permission, 'Result:', hasPermissionResult, 'User role:', authStore.user.role.name, 'Permissions:', authStore.user.role.permissions)
    return hasPermissionResult
  }

  const hasAnyPermission = (permissions: string[]): boolean => {
    return permissions.some(permission => hasPermission(permission))
  }

  const hasRole = (roleName: string): boolean => {
    return authStore.user?.role?.name === roleName
  }

  const isAdmin = computed(() => hasRole('admin'))
  const isEditor = computed(() => hasRole('editor'))

  // Permisos específicos calculados
  const canViewUsers = computed(() => {
    const result = hasPermission('users.view')
    console.log('canViewUsers computed:', result)
    return result
  })
  const canViewCrm = computed(() => {
    const result = hasPermission('crm.view')
    console.log('canViewCrm computed:', result)
    return result
  })
  const canViewAnalytics = computed(() => {
    const result = hasPermission('analytics.view')
    console.log('canViewAnalytics computed:', result)
    return result
  })
  const canViewNotes = computed(() => {
    const result = hasPermission('notes.view')
    console.log('canViewNotes computed:', result)
    return result
  })
  const canViewBackups = computed(() => {
    const result = hasPermission('backups.view')
    console.log('canViewBackups computed:', result)
    return result
  })
  const canViewSeo = computed(() => {
    const result = hasPermission('seo.view')
    console.log('canViewSeo computed:', result)
    return result
  })
  
  const canViewPages = computed(() => {
    const result = hasPermission('pages.view')
    console.log('canViewPages computed:', result)
    return result
  })
  const canViewConfig = computed(() => {
    const result = hasPermission('config.view')
    console.log('canViewConfig computed:', result)
    return result
  })
  const canViewMedia = computed(() => {
    const result = hasPermission('media.view')
    console.log('canViewMedia computed:', result)
    return result
  })

  // Funciones permitidas para editor
  const editorAllowedFunctions = computed(() => ({
    pages: canViewPages.value,
    config: canViewConfig.value,
    media: canViewMedia.value
  }))

  // Funciones restringidas para editor
  const adminOnlyFunctions = computed(() => ({
    users: canViewUsers.value,
    crm: canViewCrm.value,
    analytics: canViewAnalytics.value,
    notes: canViewNotes.value,
    backups: canViewBackups.value,
    seo: canViewSeo.value
  }))

  return {
    hasPermission,
    hasAnyPermission,
    hasRole,
    isAdmin,
    isEditor,
    canViewUsers,
    canViewCrm,
    canViewAnalytics,
    canViewNotes,
    canViewBackups,
    canViewSeo,
    canViewPages,
    canViewConfig,
    canViewMedia,
    editorAllowedFunctions,
    adminOnlyFunctions
  }
}