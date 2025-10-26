<template>
  <component 
    :is="iconComponent" 
    class="icon-global"
  />
</template>

<script setup lang="ts">
import { computed } from 'vue'
import {
  // Navigation
  HomeIcon,
  Bars3Icon,
  XMarkIcon,
  ArrowRightIcon,
  
  // Content
  DocumentTextIcon,
  DocumentIcon,
  PhotoIcon,
  VideoCameraIcon,
  
  // Actions
  PlusIcon,
  PencilIcon,
  TrashIcon,
  EyeIcon,
  EyeSlashIcon,
  CheckIcon,
  
  // Movement
  ChevronUpIcon,
  ChevronDownIcon,
  ChevronLeftIcon,
  ChevronRightIcon,
  ArrowPathIcon,
  ArrowUturnLeftIcon,
  ArrowRightOnRectangleIcon,
  
  // Interface
  CubeIcon,
  SwatchIcon,
  CogIcon,
  MagnifyingGlassIcon,
  CloudArrowUpIcon,
  CloudArrowDownIcon,
  LinkIcon,
  DocumentDuplicateIcon,
  ServerIcon,
  CalendarIcon,
  
  // Layout
  RectangleStackIcon,
  Bars3BottomLeftIcon,
  
  // Social and contact
  GlobeAltIcon,
  DevicePhoneMobileIcon,
  EnvelopeIcon,
  ClockIcon,
  MapPinIcon,
  ChatBubbleLeftRightIcon,
  HeartIcon,
  StarIcon,
  HandThumbUpIcon,
  HandThumbDownIcon,
  UserIcon,
  UsersIcon,
  BellIcon,
  LockClosedIcon,
  LockOpenIcon,
  CameraIcon,
  ShoppingCartIcon,
  CreditCardIcon,
  PlayIcon,
  PauseIcon,
  StopIcon,
  SpeakerWaveIcon,
  SpeakerXMarkIcon
} from '@heroicons/vue/24/outline'

// No imports from solid needed since we're using text/symbols for most formatting icons

interface Props {
  name: string
}

const props = defineProps<Props>()

const iconMap = {
  // Navigation
  'home': HomeIcon,
  'menu': Bars3Icon,
  'close': XMarkIcon,
  'x-mark': XMarkIcon,
  'arrow-right': ArrowRightIcon,
  
  // Content
  'document-text': DocumentTextIcon,
  'document': DocumentIcon,
  'photo': PhotoIcon,
  'video': VideoCameraIcon,
  
  // Actions
  'plus': PlusIcon,
  'pencil': PencilIcon,
  'edit': PencilIcon,
  'trash': TrashIcon,
  'delete': TrashIcon,
  'eye': EyeIcon,
  'eye-slash': EyeSlashIcon,
  'check': CheckIcon,
  'save': CheckIcon,
  
  // Movement
  'chevron-up': ChevronUpIcon,
  'chevron-down': ChevronDownIcon,
  'chevron-left': ChevronLeftIcon,
  'chevron-right': ChevronRightIcon,
  'arrow-path': ArrowPathIcon,
  'refresh': ArrowPathIcon,
  'arrow-uturn-left': ArrowUturnLeftIcon,
  'undo': ArrowUturnLeftIcon,
  'arrow-right-on-rectangle': ArrowRightOnRectangleIcon,
  'logout': ArrowRightOnRectangleIcon,
  
  // Interface
  'cube': CubeIcon,
  'swatch': SwatchIcon,
  'palette': SwatchIcon,
  'cog': CogIcon,
  'settings': CogIcon,
  'search': MagnifyingGlassIcon,
  'magnifying-glass': MagnifyingGlassIcon,
  'cloud-arrow-up': CloudArrowUpIcon,
  'upload': CloudArrowUpIcon,
  'cloud-arrow-down': CloudArrowDownIcon,
  'download': CloudArrowDownIcon,
  'link': LinkIcon,
  'document-duplicate': DocumentDuplicateIcon,
  'copy': DocumentDuplicateIcon,
  'server': ServerIcon,
  'calendar': CalendarIcon,
  
  // Layout
  'rectangle-stack': RectangleStackIcon,
  'header': RectangleStackIcon,
  'bars-3-bottom-left': Bars3BottomLeftIcon,
  'footer': Bars3BottomLeftIcon,
  
  // Contact/Social
  'globe': GlobeAltIcon,
  'phone': DevicePhoneMobileIcon,
  'envelope': EnvelopeIcon,
  'email': EnvelopeIcon,
  'clock': ClockIcon,
  'map-pin': MapPinIcon,
  'location': MapPinIcon,
  'chat-bubble': ChatBubbleLeftRightIcon,
  'comment': ChatBubbleLeftRightIcon,
  'heart': HeartIcon,
  'star': StarIcon,
  'thumbs-up': HandThumbUpIcon,
  'thumbs-down': HandThumbDownIcon,
  'user': UserIcon,
  'users': UsersIcon,
  'bell': BellIcon,
  'lock': LockClosedIcon,
  'unlock': LockOpenIcon,
  'camera': CameraIcon,
  'shopping-cart': ShoppingCartIcon,
  'credit-card': CreditCardIcon,
  'play': PlayIcon,
  'pause': PauseIcon,
  'stop': StopIcon,
  'volume-up': SpeakerWaveIcon,
  'volume-down': SpeakerXMarkIcon,
  
  // Text formatting (these are handled with text/symbols in the template)
  'bold': PencilIcon, // Fallback, but template uses <strong>B</strong>
  'italic': PencilIcon, // Fallback, but template uses <em>I</em>
  'underline': PencilIcon, // Fallback, but template uses underlined U
  'strikethrough': PencilIcon, // Fallback, but template uses strikethrough S
  
  // Text alignment (using available icons)
  'align-left': ChevronLeftIcon,
  'align-center': CubeIcon,
  'align-right': ChevronRightIcon,
  'align-justify': Bars3Icon,
  
  // Lists (these are handled with text in template)
  'list-ul': Bars3Icon, // Fallback, but template uses •
  'list-ol': Bars3Icon, // Fallback, but template uses 1.
  
  // Quote and code (these are handled with text in template)
  'quote-left': DocumentTextIcon, // Fallback, but template uses "
  'code': DocumentTextIcon, // Fallback, but template uses </>
  
  // Additional formatting (these are handled with text/emojis in template)
  'unlink': LinkIcon, // Using regular link as fallback
  'eraser': TrashIcon // Using trash as eraser alternative
}

const iconComponent = computed(() => {
  const component = iconMap[props.name as keyof typeof iconMap]
  if (!component) {
    console.warn(`Icon "${props.name}" not found`)
    return iconMap['cube'] // fallback icon
  }
  return component
})

</script>

<style>
.icon-global {
  width: 16px;
  height: auto;
}
</style>