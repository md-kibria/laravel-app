@if(isset($breadcrumb))
{
    "@type": "BreadcrumbList",
    "@id": "{{ $page['url'] }}#breadcrumb",
    "itemListElement": {!! json_encode($breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
},
@endif
{
    "@type": "{{ $page['type'] ?? 'WebPage' }}",
    "@id": "{{ $page['url'] }}#webpage",
    "url": "{{ $page['url'] }}",
    "name": "{{ $page['name'] }}",
    "datePublished": "{{ $page['datePublished'] }}",
    "dateModified": "{{ $page['dateModified'] }}",
    @if(isset($page['description']))
    "description": "{{ $page['description'] }}",
    @endif
    "isPartOf": {
        "@id": "{{ $page['url'] }}/#website"
    },
    @if(isset($image))
    "primaryImageOfPage": {
        "@id": "{{ $image['url'] }}"
    },
    @endif
    "inLanguage": "ro-RO"
    @if(isset($breadcrumb))
    ,"breadcrumb": {
        "@id": "{{ $page['url'] }}#breadcrumb"
    }
    @endif
},
@if(isset($image))
{
    "@type": "ImageObject",
    "@id": "{{ $image['url'] }}",
    "url": "{{ $image['url'] }}",
    "width": "{{ $image['width'] }}",
    "height": "{{ $image['height'] }}",
    @if(isset($image['caption']))
    "caption": "{{ $image['caption'] }}",
    @endif
    "inLanguage": "ro-RO"
},
@endif