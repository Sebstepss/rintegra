<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notes = [
            [
                'title' => 'Ideas para mejorar el sitio web',
                'content' => '<h2>Mejoras propuestas</h2><p>Lista de mejoras que se pueden implementar en el sitio web:</p><ul><li><strong>Optimización SEO:</strong> Mejorar meta descriptions y titles</li><li><strong>Performance:</strong> Implementar lazy loading en imágenes</li><li><strong>UX:</strong> Añadir animaciones suaves entre secciones</li><li><strong>Accesibilidad:</strong> Mejorar contraste de colores</li></ul><blockquote>Recordar probar en diferentes dispositivos</blockquote>',
                'category' => 'Desarrollo Web',
                'is_favorite' => true,
            ],
            [
                'title' => 'Reunión con cliente - Proyecto R-Integra',
                'content' => '<h3>Notas de la reunión del 29 de Julio</h3><p><strong>Participantes:</strong> Cliente, Gerente de Proyecto, Desarrollador</p><p><strong>Temas tratados:</strong></p><ul><li>Revisión del progreso actual</li><li>Nuevos requerimientos del cliente</li><li>Timeline de entrega</li></ul><p><strong>Acciones a seguir:</strong></p><ol><li>Implementar sistema de notas ✅</li><li>Crear sección de utilidades</li><li>Pruebas con el cliente</li></ol><p><code>Siguiente reunión: 5 de Agosto</code></p>',
                'category' => 'Reuniones',
                'is_favorite' => false,
            ],
            [
                'title' => 'Tutorial: Configuración de TipTap Editor',
                'content' => '<h2>Configuración paso a paso</h2><p>Guía para configurar el editor TipTap en Vue 3:</p><h3>1. Instalación</h3><pre><code>npm install @tiptap/vue-3 @tiptap/starter-kit</code></pre><h3>2. Configuración básica</h3><pre><code>import { Editor } from \'@tiptap/vue-3\'
import StarterKit from \'@tiptap/starter-kit\'

const editor = new Editor({
  content: \'Contenido inicial\',
  extensions: [StarterKit]
})</code></pre><p><mark>Importante:</mark> Recordar destruir el editor en onBeforeUnmount</p>',
                'category' => 'Tutoriales',
                'is_favorite' => true,
            ],
            [
                'title' => 'Lista de tareas pendientes',
                'content' => '<h3>Tareas para esta semana</h3><p>Prioridades y pendientes:</p><ul><li>✅ Crear sistema de notas</li><li>⏳ Implementar autenticación de usuarios</li><li>📋 Diseñar dashboard de analytics</li><li>🎨 Mejorar diseño responsive</li><li>🔧 Configurar deployment automático</li></ul><p><strong>Notas adicionales:</strong></p><p>Contactar al equipo de QA para coordinar las pruebas de la nueva funcionalidad de notas.</p>',
                'category' => 'Tareas',
                'is_favorite' => false,
            ],
            [
                'title' => 'Recursos útiles para desarrollo',
                'content' => '<h2>Enlaces y recursos importantes</h2><h3>Documentación</h3><ul><li><a href="https://vuejs.org">Vue.js Official Docs</a></li><li><a href="https://tiptap.dev">TipTap Editor</a></li><li><a href="https://tailwindcss.com">Tailwind CSS</a></li></ul><h3>Herramientas</h3><ul><li><strong>Design:</strong> Figma, Adobe XD</li><li><strong>Icons:</strong> Heroicons, Feather Icons</li><li><strong>Testing:</strong> Vitest, Cypress</li></ul><h3>Inspiración</h3><blockquote>Los mejores sitios web no son solo funcionales, sino que también cuentan una historia</blockquote>',
                'category' => 'Recursos',
                'is_favorite' => true,
            ],
            [
                'title' => 'Notas de debugging - Error 500',
                'content' => '<h3>Error encontrado en producción</h3><p><strong>Fecha:</strong> 30 de Julio, 2025</p><p><strong>Descripción:</strong> Error 500 al intentar subir imágenes grandes</p><h4>Pasos para reproducir:</h4><ol><li>Ir a la sección de medios</li><li>Intentar subir imagen > 5MB</li><li>Error 500 en la respuesta</li></ol><h4>Solución aplicada:</h4><pre><code>// Aumentar límite en php.ini
upload_max_filesize = 10M
post_max_size = 10M

// Validación en Laravel
\'image\' => \'required|image|max:10240\'</code></pre><p>✅ <strong>Resuelto:</strong> Error corregido y desplegado</p>',
                'category' => 'Debugging',
                'is_favorite' => false,
            ]
        ];

        foreach ($notes as $noteData) {
            Note::create($noteData);
        }
    }
}