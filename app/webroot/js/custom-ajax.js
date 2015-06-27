function reloadContent(urlDoContent) {
	ajaxFlashMessage('Carregando...');
	$.ajax({
		url: urlDoContent,
		success: function(html) {
			$('#content').html(html);
		}
	});
}
function ajaxFlashMessage(str) {
	var dlgDoContent = $("<div class=\"ajaxFlashMessage\">"+str+"</div>");
	$("body").prepend(dlgDoContent);
	setTimeout(function(){
		$(".ajaxFlashMessage").fadeOut("slow", function () {
			$(".ajaxFlashMessage").remove();
		});
	}, 2000);
}
function loadAjaxLink(target, href) {
	$(target).html(loadingstr);
	$.ajax({
		url: href,
		success: function(html) {
			$(target).html(html); 
			loadAjaxActions(target);
		}
	});
}
function loadAjaxSubmit(target, form) {
	var formObj = $(form);
	var targetObj = $(target);
	
	$.ajax({
		type: 'POST',
		url: formObj.attr('action'),
		data: formObj.serialize(),
		beforeSend: function() {
			targetObj.html(loadingstr);
		},
		success: function(html) {
			targetObj.html(html);
			loadAjaxActions(target);
		}
	});
}
function loadAjaxActions(target) {
	var targetObj = $(target);
	// Links
	targetObj.find("a.ajax").click(function(event){
		href = $(this).attr("href");		
		if(href != "#") {
			ajaxConfirm = $(this).attr("ajaxConfirm");
			if(ajaxConfirm == null || confirm(ajaxConfirm)) {
				loadAjaxLink(target, href);
			}
		}
		return false;
	});
	//Forms...
	targetObj.find("form.ajax").submit(function() {
//		updateCkeditorInstances(targetObj);
		loadAjaxSubmit(target, this);
		return false; 
	});
}