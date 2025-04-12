{
    "@type": {!! json_encode($organization['type'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
    "@id": "{{url('/')}}/#organization",
    "name": "{{ $organization['name'] }}",
    "url": "{{ $organization['url'] }}",
    "sameAs": {!! json_encode($organization['socialLinks'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
    "email": "{{ $organization['email'] }}",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $place['streetAddress'] }}",
        "addressLocality": "{{ $place['addressLocality'] }}",
        "addressRegion": "{{ $place['addressRegion'] }}",
        "postalCode": "{{ $place['postalCode'] }}",
        "addressCountry": "{{ $place['addressCountry'] }}"
    },
    "logo": {
        "@type": "ImageObject",
        "@id": "{{url('/')}}/#logo",
        "url": "{{ $organization['logo']['url'] }}",
        "contentUrl": "{{ $organization['logo']['url'] }}",
        "caption": "{{ $organization['name'] }}",
        "inLanguage": "ro-RO",
        "width": "{{ $organization['logo']['width'] }}",
        "height": "{{ $organization['logo']['height'] }}"
    },
    "priceRange": "{{ $organization['priceRange'] }}",
    "openingHours": {!! json_encode($organization['openingHours'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
    "location": {
        "@id": "{{url('/')}}/#place"
    },
    "image": {
        "@id": "{{url('/')}}/#logo"
    },
    "telephone": "{{ $organization['telephone'] }}"
},
{
    "@type": "Place",
    "@id": "{{url('/')}}/#place",
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "{{ $place['latitude'] }}",
        "longitude": "{{ $place['longitude'] }}"
    },
    "hasMap": "https://www.google.com/maps/search/?api=1&query={{ $place['latitude'] }},{{ $place['longitude'] }}",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $place['streetAddress'] }}",
        "addressLocality": "{{ $place['addressLocality'] }}",
        "addressRegion": "{{ $place['addressRegion'] }}",
        "postalCode": "{{ $place['postalCode'] }}",
        "addressCountry": "{{ $place['addressCountry'] }}"
    }
},
{
    "@type": "WebSite",
    "@id": "{{url('/')}}/#website",
    "url": "{{url('/')}}",
    "name": "{{ $organization['name'] }}",
    "publisher": {
        "@id": "{{url('/')}}/#organization"
    },
    "inLanguage": "ro-RO",
    "potentialAction": {
        "@type": "SearchAction",
        "target": "{{url('/')}}/?s={search_term_string}",
        "query-input": "required name=search_term_string"
    }
},