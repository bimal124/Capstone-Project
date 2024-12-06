ClassicEditor
			.create( document.querySelector( '.text-editor' ), {
				ckfinder: {
                 uploadUrl: BASE_URL+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
             },
				toolbar: {
					items: [
						'heading',
						'fontColor',
						'fontBackgroundColor',
						'fontFamily',
						'fontSize',
						'|',
						'bold',
						'italic',
						'underline',
						'link',
						'bulletedList',
						'numberedList',
						'todoList',
						'|',
						'alignment',
						'outdent',
						'indent',
						'|',
						'insertTable',
						'imageUpload',
						'mediaEmbed',
						
						'horizontalLine',
						'htmlEmbed',
						'pageBreak',
						'code'
					]
				},
				language: 'en',				
				licenseKey: '',
				
				
			} )
			.then( editor => {
				window.editor = editor;
		
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: dvrxjtomrvi2-a07ishkmg6oc' );
				console.error( error );
			} );