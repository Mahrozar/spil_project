@props(['name','class' => 'h-5 w-5'])

@switch($name)
    @case('eye')
        <svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 3C5 3 1.2 6.3.2 10c1 3.7 4.8 7 9.8 7s8.8-3.3 9.8-7C18.8 6.3 15 3 10 3zM10 15a5 5 0 110-10 5 5 0 010 10z"/></svg>
        @break
    @case('pencil')
        <svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M17.414 2.586a2 2 0 010 2.828L8.828 14H6v-2.828l8.586-8.586a2 2 0 012.828 0z"/></svg>
        @break
    @case('trash')
        <svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H3a1 1 0 100 2h14a1 1 0 100-2h-2V3a1 1 0 00-1-1H6zm3 6a1 1 0 00-2 0v6a1 1 0 002 0V8zm4 0a1 1 0 10-2 0v6a1 1 0 102 0V8z" clip-rule="evenodd"/></svg>
        @break
    @case('users')
        <svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M13 7a3 3 0 11-6 0 3 3 0 016 0z"/><path fill-rule="evenodd" d="M2 13.5A4.5 4.5 0 016.5 9h7A4.5 4.5 0 0118 13.5V15a1 1 0 01-1 1H3a1 1 0 01-1-1v-1.5z" clip-rule="evenodd"/></svg>
        @break
    @default
        {{-- Fallback: simple square to indicate missing icon --}}
        <svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><rect width="16" height="16" x="2" y="2" rx="2" ry="2"/></svg>
@endswitch
