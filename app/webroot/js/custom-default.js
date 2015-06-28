var loadingstr = '<div class="ajaxload"></div>';

var simplestloadingstr = 'carregando...';

var cleanregex = /[^a-zA-Z0-9]+/g;

var baseUrl = '/';

function setBaseUrl(newBaseUrl) {
	if(newBaseUrl) {
		baseUrl = newBaseUrl;
	}
}
function loadPopup($popupId) {
	if(!$popupId) {
		$popupId = 'popup';
	}
	$(".popup").unbind();
	$(".popup").click( function () {
		window.open($(this).attr("href"), $popupId, "width=800,height=600,scrollbars=yes,toolbar=no,location=no");
		return false;
	});
}
function loadCaptchaImage(imageSelector, url) {
	url+= '?';
	url+= Math.round(Math.random(0)*1000)+1;
	$(imageSelector).attr('src', url);
}
function loadDatePicker() {
	$.datepicker._gotoToday = function (id) { 
		$(id).datepicker('setDate', new Date()).datepicker('hide').blur().change();
	};
	$(".date").datepicker({
		dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
		monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
		showOn:'focus',
		nextText: 'Próximo',  
		prevText: 'Anterior',
		currentText: 'Hoje',
		inline: true,
		showButtonPanel: true,
		closeText: 'Fechar'
	});
}
function loadMask() {
	$('.date').mask('00/00/0000');
	$('.time').mask('00:00:00');
	$('.date_time').mask('00/00/0000 00:00:00');
	$('.cep').mask('00000-000');
	$('.phone').mask('(00) 0000-0000');
	$('.cpf').mask('000.000.000-00', {reverse: true});
	$('.money').mask('000.000.000.000.000,00', {reverse: true});
	
	$('.telefone').each(function(){
		var $length = $(this).val().replace(/\D/g, '').length;
		if($length > 10){
			$(this).mask('(00) 00000-0000');
		}
		else {
			$(this).mask('(00) 0000-0000');
		}
	});
	$('.telefone').keyup(function(event) {
		$(this).unmask();
		var $length = $(this).val().replace(/\D/g, '').length;
		if($length > 10){
			$(this).mask('(00) 00000-0000');
		}
		else {
			$(this).mask('(00) 0000-0000');
		}
	});
}
function loadAutoComplete(target, url) {
	$( target ).autocomplete({
		source: url,
		minLength: 1
	});
}