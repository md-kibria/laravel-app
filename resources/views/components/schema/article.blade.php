{
    "@type": "Person",
    "@id": "{{ $author['url'] }}",
    "name": "{{ $author['name'] }}",
    "url": "{{ $author['url'] }}",
    "image": {
        "@type": "ImageObject",
        "@id": "{{ $author['image'] }}",
        "url": "{{ $author['image'] }}",
        "caption": "{{ $author['name'] }}",
        "inLanguage": "ro-RO"
    },
    "sameAs": {!! json_encode($author['sameAs'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!},
    "worksFor": {
        "@id": "{{url('/')}}/#organization"
    }
},
{
    "@type": "Article",
    "headline": "{{ $article['headline'] }}",
    @if(isset($article['keywords']))
    "keywords": "{{ $article['keywords'] }}",
    @endif
    "datePublished": "{{ $article['datePublished'] }}",
    "dateModified": "{{ $article['dateModified'] }}",
    @if(isset($article['description']))
    "description": "{{ $article['description'] }}",
    @endif
    "author": {
        "@id": "{{ $author['url'] }}",
        "name": "{{ $author['name'] }}"
    },
    "publisher": {
        "@id": "{{url('/')}}/#organization"
    },
    "name": "{{ $article['headline'] }}",
    "@id": "{{ $article['url'] }}#richSnippet",
    "isPartOf": {
        "@id": "{{ $article['url'] }}#webpage"
    },
    @if(isset($article['image']))
    "image": {
        "@id": "{{ $article['image'] }}"
    },
    @endif
    "inLanguage": "ro-RO",
    "mainEntityOfPage": {
        "@id": "{{ $article['url'] }}#webpage"
    }
},