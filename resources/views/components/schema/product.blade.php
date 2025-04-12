{
    "@type": "Product",
    "name": "{{ $product['name'] }}",
    "description": "{{ $product['description'] }}",
    @if(isset($product['category']))
    "category": "{{ $product['category'] }}",
    @endif
    "mainEntityOfPage": {
        "@id": "{{ $product['url'] }}"
    },
    @if(isset($product['aggregateRating']))
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $product['aggregateRating']['ratingValue'] }}",
        "bestRating": "{{ $product['aggregateRating']['bestRating'] }}",
        "ratingCount": "{{ $product['aggregateRating']['ratingCount'] }}",
        "reviewCount": "{{ $product['aggregateRating']['reviewCount'] }}"
    },
    @endif
    @if(isset($reviews) && count($reviews) > 0)
    "review": [
        @foreach($reviews as $index => $review)
        {
            "@type": "Review",
            "@id": "{{ $product['url'] }}/#comment-{{ $review['id'] }}",
            "description": "{{ $review['description'] }}",
            "datePublished": "{{ $review['datePublished'] }}",
            "reviewRating": {
                "@type": "Rating",
                "ratingValue": "{{ $review['rating'] }}",
                "bestRating": "5",
                "worstRating": "1"
            },
            "author": {
                "@type": "Person",
                "name": "{{ $review['author'] }}"
            }
        }@if(!$loop->last),@endif
        @endforeach
    ],
    @endif
    "@id": "{{ $product['url'] }}#richSnippet",
    "image": {
        "@id": "{{ $product['image'] }}"
    }
},