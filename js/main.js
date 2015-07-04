new Vue({
	el: "#app",

	data: {
		errors: [],
		success: [] ,
		progress: false,
		maxUploadSize: ''
	},

	methods: {
		validation: function (e) {
			var files = e.target[0].files;
			var hasError = false;
			var errors = [];

			this.maxUploadSize = e.srcElement[0].attributes['data-max-upload-size'].nodeValue;

			for(var i = 0; i < files.length; i++) {
				var size = files[i].size / 1024 / 1024 ;

				if ( !(size > 0) || !(size <= this.maxUploadSize)) {
					errors.push(files[i].name +  ' size must be less than or equal ' + this.maxUploadSize + 'mb.');
					hasError = true;
				}
			}

			if(hasError) {
				this.success= '';
				this.errors = errors;
				errors = [];
				return;
			}

			return this.startUpload(e);

		},

		upload: function (e) {
			e.preventDefault();
			this.validation(e);
		},

		startUpload: function(e) {
			var self = this;
			var formdata = new FormData(e.target);
			formdata.append("max-upload-size", this.maxUploadSize);

			$.ajax({
				 type: 'POST',
				 url: "/api/uploader.php",
				 data: formdata,
				 cache: false,
			           contentType: false,
			           processData: false,
				 xhr: function() {
				    var xhr = new window.XMLHttpRequest();

				    xhr.upload.addEventListener("progress", function(evt){
				      if (evt.lengthComputable) {
				        var percentComplete = ( (evt.loaded / evt.total)  * 100 ) + "%";
				        self.progress = true;
				        self.$$.progressbar.style.width = percentComplete;
				      }
				    }, false);
				    
				    return xhr;
				 },

				 success: function(response){
					self.progress = false;
				  	self.$$.progressbar.style.width = 0+ "%";
				  	self.errors = [];
				    	self.success = JSON.parse(response);
				    	self.$$.clear.click();
				 },
				 error: function(response){
				 	self.progress = false;
				    	self.$$.progressbar.style.width = 0 + "%";
				    	self.success = '';
				    	self.errors.push(response.responseText);
				  }
			});
		}
	}
});
