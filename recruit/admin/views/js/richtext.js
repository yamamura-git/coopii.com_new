tinymce.init({
	selector: 'textarea',
	plugins: 'image link autolink preview code',
	paste_as_text: true,
	toolbar: 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image code | link | preview',
	menubar: false,
	relative_urls: false,
	language: 'ja',
	automatic_uploads: true,
	images_file_types: 'jpg,svg,webp,gif,png',
	file_picker_types: 'image',
	file_picker_callback: function (cb, value, meta) {
		var input = document.createElement('input');
		input.setAttribute('type', 'file');
		input.setAttribute('accept', 'image/*');

		input.onchange = function () {
			var file = this.files[0];

			var reader = new FileReader();
			reader.onload = function () {
				var id = 'blobid' + (new Date()).getTime();
				var blobCache = tinymce.activeEditor.editorUpload.blobCache;
				var base64 = reader.result.split(',')[1];
				var blobInfo = blobCache.create(id, file, base64);
				blobCache.add(blobInfo);

				cb(blobInfo.blobUri(), {
					title: file.name
				});
			};
			reader.readAsDataURL(file);
		};

		input.click();
	},
});
