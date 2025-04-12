<script>
    tinymce.init({
        selector: '#{{$id}}',
        promotion: false,
        plugins: 'image code lists table formatselect link',
        toolbar: 'formatselect | bold italic link image | alignleft aligncenter alignright |  bullist numlist | table',
        block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3',
        automatic_uploads: true,
        // Add this to convert relative URLs to absolute
        relative_urls: false,
        remove_script_host: false,
        // Add this to set a document base URL if needed
        document_base_url: window.location.origin,
        images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/admin/upload-image');

            // Add CSRF token header
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            if (csrfToken) {
                xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            }

            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = () => {
                if (xhr.status === 403) {
                    reject({
                        message: 'HTTP Error: ' + xhr.status,
                        remove: true
                    });
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    reject('HTTP Error: ' + xhr.status);
                    return;
                }

                try {
                    const json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    // Make sure the location is an absolute URL
                    let location = json.location;
                    if (!location.startsWith('http') && !location.startsWith('/')) {
                        location = '/' + location.replace(/^\.\.\/+/, '');
                    }

                    resolve(location);
                } catch (e) {
                    reject('Invalid JSON: ' + xhr.responseText);
                }
            };

            xhr.onerror = () => {
                reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        })
    });
</script>