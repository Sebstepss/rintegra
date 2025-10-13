<div class="lead-converter-block-content">
    @if(isset($block['data']['form_id']))
        @php
            $form = \App\Models\Form::find($block['data']['form_id']);
        @endphp
        
        @if($form)
            <div class="lead-form">
                @if(isset($block['data']['title']))
                    <h2 class="form-title">{{ $block['data']['title'] }}</h2>
                @endif
                
                @if(isset($block['data']['description']))
                    <p class="form-description">{{ $block['data']['description'] }}</p>
                @endif
                
                <form action="{{ url('/api/forms/' . $form->id . '/submit') }}" 
                      method="POST" 
                      class="contact-form"
                      id="lead-form-{{ $form->id }}">
                    @csrf
                    
                    @if($form->fields)
                        @php
                            $fields = json_decode($form->fields, true);
                        @endphp
                        
                        @foreach($fields as $field)
                            <div class="form-group">
                                <label for="{{ $field['name'] }}" class="form-label">
                                    {{ $field['label'] }}
                                    @if(isset($field['required']) && $field['required'])
                                        <span class="required">*</span>
                                    @endif
                                </label>
                                
                                @switch($field['type'])
                                    @case('textarea')
                                        <textarea name="{{ $field['name'] }}" 
                                                id="{{ $field['name'] }}"
                                                class="form-input"
                                                @if(isset($field['required']) && $field['required']) required @endif
                                                placeholder="{{ $field['placeholder'] ?? '' }}"></textarea>
                                        @break
                                        
                                    @case('select')
                                        <select name="{{ $field['name'] }}" 
                                                id="{{ $field['name'] }}"
                                                class="form-input"
                                                @if(isset($field['required']) && $field['required']) required @endif>
                                            <option value="">Selecciona una opción</option>
                                            @if(isset($field['options']))
                                                @foreach($field['options'] as $option)
                                                    <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @break
                                        
                                    @default
                                        <input type="{{ $field['type'] ?? 'text' }}" 
                                               name="{{ $field['name'] }}" 
                                               id="{{ $field['name'] }}"
                                               class="form-input"
                                               @if(isset($field['required']) && $field['required']) required @endif
                                               placeholder="{{ $field['placeholder'] ?? '' }}">
                                @endswitch
                            </div>
                        @endforeach
                    @endif
                    
                    <button type="submit" class="form-submit btn-flat">
                        {{ $block['data']['submit_text'] ?? 'Enviar' }}
                    </button>
                </form>
                
                <div id="form-message-{{ $form->id }}" class="form-message" style="display: none;"></div>
            </div>
        @else
            <div class="form-error">
                <p>Formulario no encontrado (ID: {{ $block['data']['form_id'] }})</p>
            </div>
        @endif
    @else
        <div class="form-error">
            <p>No se ha configurado un formulario para este bloque.</p>
        </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if(isset($form))
    const form = document.getElementById('lead-form-{{ $form->id }}');
    const messageDiv = document.getElementById('form-message-{{ $form->id }}');
    
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const submitBtn = form.querySelector('.form-submit');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = 'Enviando...';
            submitBtn.disabled = true;
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                const result = await response.json();
                
                if (response.ok) {
                    messageDiv.innerHTML = '<div class="alert alert-success">¡Mensaje enviado correctamente!</div>';
                    form.reset();
                } else {
                    messageDiv.innerHTML = '<div class="alert alert-error">Error al enviar el mensaje. Inténtalo de nuevo.</div>';
                }
            } catch (error) {
                messageDiv.innerHTML = '<div class="alert alert-error">Error de conexión. Inténtalo de nuevo.</div>';
            }
            
            messageDiv.style.display = 'block';
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        });
    }
    @endif
});
</script>
@endpush