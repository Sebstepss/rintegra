export interface BaseBlock {
  id: string
  type: string
  order: number
  customId?: string
  customClass?: string
  customCSS?: string
}

export interface HeroBlock extends BaseBlock {
  type: 'hero'
  title: string
  subtitle: string
  description: string
  backgroundImage: string
  backgroundType: 'image' | 'gradient' | 'solid'
  backgroundGradient?: {
    color1: string
    color2: string
    direction: string
  }
  backgroundColor?: string
  textAlign: 'left' | 'center' | 'right'
  textColor: string
  buttonText: string
  buttonLink: string
  buttonStyle: 'outline' | 'flat' | 'gradient'
  height: 'small' | 'medium' | 'large' | 'full'
  overlay: {
    enabled: boolean
    color: string
    opacity: number
  }
}

export interface TextItem {
  id: string
  content: string
}

export interface TextColumn {
  id: string
  backgroundColor?: string
  textColor?: string
  texts: TextItem[]
}

export interface TextBlock extends BaseBlock {
  type: 'text'
  columnsCount: 1 | 2 | 3 | 4
  columns: TextColumn[]
  gap: 'none' | 'small' | 'medium' | 'large'
  padding: 'none' | 'small' | 'medium' | 'large'
  backgroundColor?: string
}

export interface ImageBlock extends BaseBlock {
  type: 'image'
  src: string
  alt: string
  caption?: string
  alignment: 'left' | 'center' | 'right'
  size: 'small' | 'medium' | 'large' | 'full'
  borderRadius: number
  shadow: boolean
}

export interface CallToActionBlock extends BaseBlock {
  type: 'cta'
  title: string
  description: string
  buttonText: string
  buttonLink: string
  buttonStyle: 'outline' | 'flat' | 'gradient'
  backgroundColor: string
  textColor: string
  textAlign: 'left' | 'center' | 'right'
  padding: 'small' | 'medium' | 'large'
}

export interface ColumnsBlock extends BaseBlock {
  type: 'columns'
  columns: Array<{
    id: string
    title: string
    content: string
    image?: string
    buttonText?: string
    buttonLink?: string
  }>
  columnsCount: 2 | 3 | 4
  gap: 'small' | 'medium' | 'large'
  backgroundColor?: string
  padding: 'small' | 'medium' | 'large'
}

export interface SpacerBlock extends BaseBlock {
  type: 'spacer'
  height: number
  backgroundColor?: string
}

export interface BannerIntegraBlock extends BaseBlock {
  type: 'banner-integra'
  title: string
  description: string
  buttonText: string
  buttonLink: string
  backgroundGradient: {
    colorStart: string
    colorEnd: string
  }
  backgroundImage: string
  backgroundImageOpacity: number
  personImage: string
  titleColor: string
  descriptionColor: string
}

export interface CualidadItem {
  image: string
  text: string
  textColor?: string
}

export interface CualidadesBlock extends BaseBlock {
  type: 'cualidades'
  title: string
  titleColor?: string
  itemsTextColor?: string
  backgroundGradient: {
    colorStart: string
    colorEnd: string
  }
  items: CualidadItem[]
}

export interface TextoyVideoBlock extends BaseBlock {
  type: 'textoy-video'
  title: string
  titleColor: string
  description: string
  descriptionColor: string
  buttonText: string
  buttonLink: string
  buttonColor: string
  buttonTextColor: string
  videoType: 'media' | 'youtube'
  videoUrl: string // URL de YouTube o ID de media
  videoMediaId?: number // ID del media si es tipo media
  backgroundColor: string
}

export interface ContainerBlock extends BaseBlock {
  type: 'container'
  backgroundType: 'color' | 'gradient' | 'image'
  backgroundColor?: string
  backgroundGradient?: {
    colorStart: string
    colorEnd: string
    direction: 'to right' | 'to left' | 'to bottom' | 'to top' | '45deg' | '135deg'
  }
  backgroundImage?: string
  backgroundImageOpacity?: number
  padding: 'none' | 'small' | 'medium' | 'large'
  children: Block[]
}

export interface ImageGalleryItem {
  id: string
  mediaId?: number
  src: string
  alt: string
  caption?: string
  link?: string
  linkTarget?: '_blank' | '_self'
}

export interface ImageGalleryBlock extends BaseBlock {
  type: 'image-gallery'
  columnsCount: 1 | 2 | 3 | 4 | 5 | 6
  gap: 'none' | 'small' | 'medium' | 'large'
  padding: 'none' | 'small' | 'medium' | 'large'
  backgroundColor?: string
  aspectRatio: 'square' | '4:3' | '16:9' | '3:4' | '9:16' | 'auto'
  maskType: 'none' | 'circle' | 'rounded' | 'custom'
  customMask?: string // SVG path para máscaras personalizadas
  borderRadius?: number // Para rounded mask
  hoverEffect: 'none' | 'zoom' | 'fade' | 'lift'
  alignment: 'left' | 'center' | 'right'
  items: ImageGalleryItem[]
}

export interface TeamMemberSocial {
  platform: 'facebook' | 'twitter' | 'instagram' | 'linkedin' | 'github' | 'email' | 'website'
  url: string
}

export interface TeamMemberItem {
  id: string
  mediaId?: number
  photo: string
  name: string
  position: string
  description: string
  socials: TeamMemberSocial[]
}

export interface TeamBlock extends BaseBlock {
  type: 'team'
  columnsCount: 1 | 2 | 3 | 4 | 5 | 6
  gap: 'none' | 'small' | 'medium' | 'large'
  padding: 'none' | 'small' | 'medium' | 'large'
  backgroundColor?: string
  aspectRatio: 'square' | '4:3' | '16:9' | '3:4' | '9:16' | 'auto'
  maskType: 'none' | 'circle' | 'rounded' | 'custom'
  customMask?: string // SVG path para máscaras personalizadas
  borderRadius?: number // Para rounded mask
  hoverEffect: 'none' | 'zoom' | 'fade' | 'lift'
  alignment: 'left' | 'center' | 'right'
  members: TeamMemberItem[]
}

export interface ServiceItem {
  id: string
  icon: string // URL del SVG desde media picker
  mediaId?: number
  title: string
  shortDescription: string
  longDescription: string // HTML con texto enriquecido
}

export interface ServicesBlock extends BaseBlock {
  type: 'services'
  title?: string
  subtitle?: string
  columnsCount: 1 | 2 | 3 | 4
  gap: 'none' | 'small' | 'medium' | 'large'
  padding: 'none' | 'small' | 'medium' | 'large'
  alignment: 'left' | 'center' | 'right'
  backgroundColor?: string
  displayMode: 'tabs' | 'accordion' | 'cards'
  iconSize: 'small' | 'medium' | 'large'
  services: ServiceItem[]
}

export interface MapBlock extends BaseBlock {
  type: 'map'
  title?: string
  address: string
  zoom: number
  height: number
  padding: 'none' | 'small' | 'medium' | 'large'
  backgroundColor?: string
}

export interface LeadConverterValueStackItem {
  id: string
  text: string
  value: string
  enabled: boolean
}

export interface LeadConverterUrgencyItem {
  id: string
  text: string
  enabled: boolean
  animated: boolean
}

export interface LeadConverterTrustItem {
  id: string
  text: string
  icon: string
  enabled: boolean
}

export interface LeadConverterBlock extends BaseBlock {
  type: 'lead-converter'
  // Encabezados
  headline: string
  subheadline: string
  
  // Countdown
  countdownLabel: string
  countdownHours: number
  showCountdown: boolean
  
  // Formulario
  formAction: string // URL webhook
  formMethod: 'POST' | 'GET'
  nameLabel: string
  phoneLabel: string
  emailLabel: string
  situationLabel: string
  urgencyLabel: string
  ctaButtonText: string
  
  // Opciones dropdown
  situationOptions: string[]
  urgencyOptions: string[]
  
  // Value Stack
  valueStackTitle: string
  valueStackItems: LeadConverterValueStackItem[]
  totalValue: string
  todayPrice: string
  showValueStack: boolean
  
  // Elementos de urgencia
  urgencyItems: LeadConverterUrgencyItem[]
  progressBarText: string
  progressBarTotal: number
  progressBarCurrent: number
  showUrgencyElements: boolean
  
  // Elementos de confianza
  trustItems: LeadConverterTrustItem[]
  showTrustElements: boolean
  
  // Configuración de colores (override opcional)
  useCustomColors: boolean
  primaryGreen?: string
  primaryGold?: string
  beige?: string
  terracotta?: string
  white?: string
  
  // Layout
  padding: 'none' | 'small' | 'medium' | 'large'
  backgroundColor?: string
}

export type Block = HeroBlock | TextBlock | ImageBlock | CallToActionBlock | ColumnsBlock | SpacerBlock | BannerIntegraBlock | CualidadesBlock | TextoyVideoBlock | ContainerBlock | ImageGalleryBlock | TeamBlock | ServicesBlock | MapBlock | LeadConverterBlock

export interface BlockTemplate {
  type: string
  name: string
  icon: string
  description: string
  defaultProps: Partial<Block>
}