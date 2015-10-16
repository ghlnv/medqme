function loadCkeditorAjaxForm(selector) {
	$(selector).submit(function(){
		$ckeditorId = $(this).find('textarea').attr('id');
		instance = CKEDITOR.instances[$ckeditorId];
		instance.updateElement();
		instance.destroy(true);
	});
}
function loadURLFromCkeditorPlugin(ckFuncNum, target) {
	$(target).click(function() {
		confirmMsg = $(this).attr('confirm');
		if(confirmMsg && !confirm(confirmMsg)) {
			return false;
		}
		href = $(this).attr('href');
		window.opener.CKEDITOR.tools.callFunction(ckFuncNum, href);
		window.top.close() ;
		window.top.opener.focus() ;
		return false;
	});
}
function loadSimpleCkeditor(ckeditorId, config) {
	var instance = CKEDITOR.instances[ckeditorId];
	if (instance) {
//		instance.destroy(true);
		CKEDITOR.remove(instance);
	}
	if(!config) {
		config = {};
	}
	config.toolbar = 'Padrao';
	config.autoGrow_onStartup = true;
	config.autoGrow_bottomSpace = 200;
	config.autoGrow_maxHeight = 800;
	CKEDITOR.replace(ckeditorId, config);
}
function loadTextoBasicoCkeditor(ckeditorId, config) {
	var instance = CKEDITOR.instances[ckeditorId];
	if (instance) {
		delete CKEDITOR.instances[ckeditorId];
//		CKEDITOR.remove(instance);
	}
	if(!config) {
		config = {};
	}
	config.forcePasteAsPlainText = true;
	config.toolbar = 'TextoBasico';
	CKEDITOR.replace(ckeditorId, config);
}
function loadGenericCkeditor(ckeditorId, config) {
	var instance = CKEDITOR.instances[ckeditorId];
	if (instance) {
		CKEDITOR.remove(instance);
	}
	if(!config) {
		config = {};
	}
	CKEDITOR.replace(ckeditorId, config);
}
function updateAllCkeditorInstances() {
	if(CKEDITOR.instances) {
		$('textarea').each(function() {
			if(CKEDITOR.instances[$(this).attr('id')]) {
				instance = CKEDITOR.instances[$(this).attr('id')];
				instance.updateElement();
				instance.destroy();
			}
		});
	}
}
function updateCkeditorInstances(obj) {
	if(CKEDITOR.instances) {
		obj.find('textarea').each(function() {
			instance = CKEDITOR.instances[$(this).attr('id')];
			if(instance) {
				instance.updateElement();
				instance.destroy();
			}
		});
	}
}