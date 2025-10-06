/**
 * Utilidades para manejo de URLs de medios en entorno XAMPP local
 */

/**
 * Construye la URL completa para acceder a un archivo de medios
 * @param url - URL del archivo de medios desde el backend
 * @returns URL completa accesible desde el navegador
 */
export function buildMediaUrl(url: string): string {
  if (!url) return ''
  
  // Si es una URL completa, devolverla tal cual
  if (url.startsWith('http://') || url.startsWith('https://')) {
    return url
  }
  
  // Para URLs de storage (imágenes y archivos)
  if (url.includes('/storage/')) {
    const storagePath = url.split('/storage/')[1]

    if (import.meta.env.DEV) {
      // Local: storage está dentro del backend Laravel
      return `http://localhost/rintegra/backend/public/storage/${storagePath}`
    } else {
      // Producción: usar symlink de storage
      return `https://r-integra.com/storage/${storagePath}`
    }
  }
  
  // Para otras URLs del API
  const urlPath = url.startsWith('/') ? url : `/${url}`
  const baseUrl = import.meta.env.DEV 
    ? 'http://localhost/rintegra/backend/public'    // Local XAMPP
    : 'https://r-integra.com/api'                   // Producción
  return `${baseUrl}${urlPath}`
}

/**
 * Obtiene el icono apropiado según el tipo MIME del archivo
 * @param mimeType - Tipo MIME del archivo
 * @returns Clase CSS del icono FontAwesome
 */
export function getFileIcon(mimeType: string): string {
  if (mimeType.startsWith('image/')) return 'fas fa-image'
  if (mimeType.startsWith('video/')) return 'fas fa-video'
  if (mimeType.includes('pdf')) return 'fas fa-file-pdf'
  if (mimeType.includes('word')) return 'fas fa-file-word'
  if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'fas fa-file-excel'
  if (mimeType.includes('powerpoint') || mimeType.includes('presentation')) return 'fas fa-file-powerpoint'
  return 'fas fa-file'
}

/**
 * Formatea el tamaño de archivo en bytes a formato legible
 * @param bytes - Tamaño en bytes
 * @returns Tamaño formateado (ej: "1.2 MB")
 */
export function formatFileSize(bytes: number): string {
  if (bytes === 0) return '0 Bytes'
  const k = 1024
  const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB']
  const i = Math.floor(Math.log(bytes) / Math.log(k))
  return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i]
}

/**
 * Obtiene el nombre para mostrar de un archivo de medios
 * @param media - Objeto de medios del backend
 * @returns Nombre a mostrar (prioriza alt_text, luego name, luego file_name)
 */
export function getMediaDisplayName(media: any): string {
  if (!media) return ''
  return media.alt_text || media.name || media.file_name || 'Archivo sin nombre'
}

/**
 * Trunca un nombre de archivo si es muy largo
 * @param name - Nombre del archivo
 * @param maxLength - Longitud máxima (por defecto 20)
 * @returns Nombre truncado con "..." si es necesario
 */
export function truncateFileName(name: string, maxLength: number = 20): string {
  if (name.length <= maxLength) return name
  return name.substring(0, maxLength) + '...'
}