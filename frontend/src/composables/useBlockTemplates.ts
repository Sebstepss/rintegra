import type { BlockTemplate } from '@/types/blocks'

export function useBlockTemplates() {
  const blockTemplates: BlockTemplate[] = [
    {
      type: 'banner-integra',
      name: 'Banner R-Integra',
      icon: 'fas fa-chart-line',
      description: 'Banner especializado para servicios financieros y contables',
      defaultProps: {
        type: 'banner-integra',
        title: 'Organización financiera con visión estratégica',
        description: 'Acompañamos a empresarios, emprendedores y profesionales a cumplir con sus obligaciones contables y tributarias, estructurando procesos claros, sostenibles y alineados con sus objetivos de crecimiento.',
        buttonText: 'Agenda aquí tu cita',
        buttonLink: '#contacto',
        backgroundGradient: {
          colorStart: '#052b1b',
          colorEnd: '#0c6a44'
        },
        backgroundImage: '',
        backgroundImageOpacity: 30,
        personImage: '',
        titleColor: '#ffffff',
        descriptionColor: '#ffffff'
      }
    },
    {
      type: 'text',
      name: 'Bloque de Texto',
      icon: 'fas fa-align-left',
      description: 'Bloque de contenido de texto con columnas y formato enriquecido',
      defaultProps: {
        type: 'text',
        columnsCount: 1,
        columns: [
          {
            id: 'temp-id',
            backgroundColor: '',
            textColor: '',
            texts: [
              {
                id: 'temp-id',
                content: '<h2>Título del Contenido</h2>'
              },
              {
                id: 'temp-id',
                content: '<p>Este es un párrafo de contenido que puede incluir <strong>texto en negrita</strong>, <em>cursiva</em> y <a href="#">enlaces</a>.</p>'
              }
            ]
          }
        ],
        gap: 'medium',
        padding: 'medium',
        backgroundColor: ''
      }
    },
    {
      type: 'spacer',
      name: 'Espaciador',
      icon: 'fas fa-arrows-alt-v',
      description: 'Espacio en blanco para separar secciones',
      defaultProps: {
        type: 'spacer',
        height: 60
      }
    },
    {
      type: 'cualidades',
      name: 'Cualidades',
      icon: 'fas fa-star',
      description: 'Bloque de cualidades con imágenes y texto en columnas',
      defaultProps: {
        type: 'cualidades',
        title: 'Un enfoque claro, confiable y estructurado',
        backgroundGradient: {
          colorStart: '#0c6a44',
          colorEnd: '#052b1b'
        },
        items: [
          {
            image: '',
            text: 'Diagnóstico financiero y contable inicial'
          },
          {
            image: '',
            text: 'Asesoría personalizada'
          },
          {
            image: '',
            text: 'Implementación de procesos'
          },
          {
            image: '',
            text: 'Seguimiento continuo'
          }
        ]
      }
    },
    {
      type: 'textoy-video',
      name: 'Texto y Video',
      icon: 'fas fa-play-circle',
      description: 'Sección de dos columnas con texto y video en formato 4:5',
      defaultProps: {
        type: 'textoy-video',
        title: 'Solidez contable, proyección empresarial',
        titleColor: '#2c3e50',
        description: '<p>En R-INTEGRA ayudamos a nuestros clientes a organizar sus finanzas, cumplir sus obligaciones y tomar decisiones estratégicas con información clara y confiable.</p><p>Unimos conocimiento técnico, planeación fiscal y visión de negocio para construir estructuras financieras sólidas, alineadas con los objetivos de crecimiento de cada empresa o profesional.</p>',
        descriptionColor: '#666666',
        buttonText: 'Conoce más sobre nosotros',
        buttonLink: '#about',
        buttonColor: '#007bff',
        buttonTextColor: '#ffffff',
        videoType: 'youtube',
        videoUrl: '',
        backgroundColor: '#ffffff'
      }
    },
    {
      type: 'container',
      name: 'Contenedor',
      icon: 'fas fa-layer-group',
      description: 'Contenedor para agrupar otros bloques con fondo personalizable',
      defaultProps: {
        type: 'container',
        backgroundType: 'color',
        backgroundColor: '#ffffff',
        backgroundGradient: {
          colorStart: '#000000',
          colorEnd: '#ffffff',
          direction: 'to right'
        },
        backgroundImage: '',
        backgroundImageOpacity: 100,
        padding: 'medium',
        children: []
      }
    },
    {
      type: 'image-gallery',
      name: 'Galería de Imágenes',
      icon: 'fas fa-images',
      description: 'Galería de imágenes en grid con máscaras y efectos personalizables',
      defaultProps: {
        type: 'image-gallery',
        columnsCount: 3,
        gap: 'medium',
        padding: 'medium',
        backgroundColor: '',
        aspectRatio: 'square',
        maskType: 'none',
        customMask: '',
        borderRadius: 12,
        hoverEffect: 'zoom',
        alignment: 'center',
        items: []
      }
    },
    {
      type: 'team',
      name: 'Equipo de Trabajo',
      icon: 'fas fa-users',
      description: 'Bloque para mostrar miembros del equipo con fotos, información y redes sociales',
      defaultProps: {
        type: 'team',
        columnsCount: 3,
        gap: 'medium',
        padding: 'medium',
        backgroundColor: '',
        aspectRatio: 'square',
        maskType: 'circle',
        customMask: '',
        borderRadius: 12,
        hoverEffect: 'lift',
        alignment: 'center',
        members: []
      }
    },
    {
      type: 'services',
      name: 'Servicios',
      icon: 'fas fa-briefcase',
      description: 'Bloque de servicios con tabs, acordeón o tarjetas con íconos y descripciones',
      defaultProps: {
        type: 'services',
        title: 'Nuestros Servicios',
        subtitle: 'Descubre lo que podemos hacer por ti',
        columnsCount: 3,
        gap: 'medium',
        padding: 'medium',
        alignment: 'center',
        backgroundColor: '',
        displayMode: 'tabs',
        iconSize: 'medium',
        services: []
      }
    },
    {
      type: 'map',
      name: 'Mapa de Google',
      icon: 'fas fa-map-marked-alt',
      description: 'Mapa de Google Maps embebido sin necesidad de API key',
      defaultProps: {
        type: 'map',
        title: '',
        address: 'Bogotá, Colombia',
        zoom: 12,
        height: 400,
        padding: 'medium',
        backgroundColor: ''
      }
    },
    {
      type: 'lead-converter',
      name: 'Conversor de Leads',
      icon: 'fas fa-magnet',
      description: 'Bloque de captura de leads con formulario de diagnóstico gratuito y countdown timer',
      defaultProps: {
        type: 'lead-converter',
        // Encabezados
        headline: 'DIAGNÓSTICO FINANCIERO GRATUITO: Descubre Exactamente Cuánto Dinero Estás Perdiendo',
        subheadline: 'Análisis personalizado de 15 minutos con nuestro especialista. Identifica pérdidas ocultas y obtén tu plan de acción específico.',
        
        // Countdown
        countdownLabel: 'OFERTA ESPECIAL TERMINA EN:',
        countdownHours: 24,
        showCountdown: true,
        
        // Formulario
        formAction: 'https://tu-webhook.com/lead',
        formMethod: 'POST',
        nameLabel: 'Tu nombre completo',
        phoneLabel: 'WhatsApp (para agendar tu sesión)',
        emailLabel: 'Email principal',
        situationLabel: '¿Cuál es tu situación actual?',
        urgencyLabel: '¿Qué tan urgente es resolverlo?',
        ctaButtonText: 'RESERVAR MI DIAGNÓSTICO AHORA',
        
        // Opciones dropdown
        situationOptions: [
          'Tengo 1-2 propiedades, no sé si son rentables',
          'Tengo 3-5 propiedades totalmente desorganizadas',
          'Tengo 6+ propiedades, es un caos financiero',
          'Tengo negocios + propiedades mezclado todo',
          'Soy empresario, quiero diversificar mis ingresos',
          'Tengo dinero ahorrado, busco mejores opciones',
          'Heredé propiedades, no sé qué hacer con ellas'
        ],
        urgencyOptions: [
          'MUY URGENTE - Lo necesito resolver ya mismo',
          'URGENTE - En las próximas 4-6 semanas',
          'IMPORTANTE - En los próximos 2-3 meses',
          'INTERESANTE - Cuando encuentre la solución correcta'
        ],
        
        // Value Stack
        valueStackTitle: 'TU DIAGNÓSTICO INCLUYE:',
        valueStackItems: [
          {
            id: 'vs1',
            text: 'Análisis de rentabilidad real',
            value: '$300K',
            enabled: true
          },
          {
            id: 'vs2',
            text: 'Identificación de pérdidas ocultas',
            value: '$250K',
            enabled: true
          },
          {
            id: 'vs3',
            text: 'Plan de acción personalizado 90 días',
            value: '$400K',
            enabled: true
          },
          {
            id: 'vs4',
            text: 'Roadmap de optimización específico',
            value: '$200K',
            enabled: true
          },
          {
            id: 'vs5',
            text: 'Sesión de seguimiento incluida',
            value: '$150K',
            enabled: true
          }
        ],
        totalValue: '$1,300K',
        todayPrice: 'COMPLETAMENTE GRATIS',
        showValueStack: true,
        
        // Elementos de urgencia
        urgencyItems: [
          {
            id: 'u1',
            text: 'Solo 12 diagnósticos disponibles esta semana',
            enabled: true,
            animated: true
          },
          {
            id: 'u2',
            text: '+47 personas viendo esta página ahora mismo',
            enabled: true,
            animated: false
          }
        ],
        progressBarText: 'Espacios disponibles:',
        progressBarTotal: 20,
        progressBarCurrent: 8,
        showUrgencyElements: true,
        
        // Elementos de confianza
        trustItems: [
          {
            id: 't1',
            text: '+2,847 diagnósticos realizados',
            icon: '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M5,16L3,5l5.5,5L12,4l3.5,6L21,5l-2,11H5zm2.7-2h8.6l0.9-5.4l-2.1,1.4l-3.1-5.3L9,10.1L6.8,8.6L8.7,14z"/></svg>',
            enabled: true
          },
          {
            id: 't2',
            text: '4.9/5 estrellas de satisfacción',
            icon: '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"/></svg>',
            enabled: true
          },
          {
            id: 't3',
            text: 'Información 100% confidencial',
            icon: '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12,17A2,2 0 0,0 14,15C14,13.89 13.1,13 12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V10C4,8.89 4.9,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z"/></svg>',
            enabled: true
          },
          {
            id: 't4',
            text: 'Sesión por videollamada/WhatsApp',
            icon: '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17,10.5V7A1,1 0 0,0 16,6H4A1,1 0 0,0 3,7V17A1,1 0 0,0 4,18H16A1,1 0 0,0 17,17V13.5L21,17.5V6.5L17,10.5Z"/></svg>',
            enabled: true
          }
        ],
        showTrustElements: true,
        
        // Configuración de colores
        useCustomColors: false,
        primaryGreen: '#0C6444',
        primaryGold: '#D1AE6A',
        beige: '#EFE3D5',
        terracotta: '#B86C55',
        white: '#FFFEF9',
        
        // Layout
        padding: 'medium',
        backgroundColor: ''
      }
    }
  ]

  const getTemplateByType = (type: string): BlockTemplate | undefined => {
    return blockTemplates.find(template => template.type === type)
  }

  const createBlockFromTemplate = (type: string): any => {
    const template = getTemplateByType(type)
    if (!template) return null

    const baseBlock = {
      id: generateId(),
      order: 0,
      customId: '',
      customClass: '',
      customCSS: '',
      ...template.defaultProps
    }

    // Si es un bloque de texto, generar IDs únicos para columnas y textos y sincronizar columnsCount
    if (type === 'text' && baseBlock.columns) {
      baseBlock.columns = baseBlock.columns.map((column: any) => ({
        ...column,
        id: generateId(),
        texts: column.texts.map((text: any) => ({
          ...text,
          id: generateId()
        }))
      }))
      
      // Asegurar que columnsCount coincida con el número de columnas
      baseBlock.columnsCount = baseBlock.columns.length
      console.log('Template created for text block with columnsCount:', baseBlock.columnsCount, 'columns:', baseBlock.columns.length)
    }

    // Si es un bloque de galería de imágenes, inicializar items con IDs únicos
    if (type === 'image-gallery') {
      baseBlock.items = baseBlock.items || []
      if (baseBlock.items.length > 0) {
        baseBlock.items = baseBlock.items.map((item: any) => ({
          ...item,
          id: generateId()
        }))
      }
      console.log('Template created for image-gallery block with', baseBlock.items.length, 'items')
    }

    // Si es un bloque de equipo, inicializar members con IDs únicos
    if (type === 'team') {
      baseBlock.members = baseBlock.members || []
      if (baseBlock.members.length > 0) {
        baseBlock.members = baseBlock.members.map((member: any) => ({
          ...member,
          id: generateId(),
          socials: member.socials?.map((social: any) => ({ ...social })) || []
        }))
      }
      console.log('Template created for team block with', baseBlock.members.length, 'members')
    }

    // Si es un bloque de servicios, inicializar services con IDs únicos
    if (type === 'services') {
      baseBlock.services = baseBlock.services || []
      if (baseBlock.services.length > 0) {
        baseBlock.services = baseBlock.services.map((service: any) => ({
          ...service,
          id: generateId()
        }))
      }
      console.log('Template created for services block with', baseBlock.services.length, 'services')
    }

    // Si es un bloque de conversor de leads, asegurar IDs únicos para todos los arrays
    if (type === 'lead-converter') {
      // Asegurar arrays y generar IDs únicos para value stack items
      baseBlock.valueStackItems = (baseBlock.valueStackItems || []).map((item: any) => ({
        ...item,
        id: item.id || generateId()
      }))
      
      // Asegurar arrays y generar IDs únicos para urgency items
      baseBlock.urgencyItems = (baseBlock.urgencyItems || []).map((item: any) => ({
        ...item,
        id: item.id || generateId()
      }))
      
      // Asegurar arrays y generar IDs únicos para trust items
      baseBlock.trustItems = (baseBlock.trustItems || []).map((item: any) => ({
        ...item,
        id: item.id || generateId()
      }))
      
      console.log('Template created for lead-converter block')
    }

    return baseBlock
  }

  const generateId = (): string => {
    return Date.now().toString(36) + Math.random().toString(36).substr(2)
  }

  return {
    blockTemplates,
    getTemplateByType,
    createBlockFromTemplate,
    generateId
  }
}