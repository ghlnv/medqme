function loadDlgImportar() {
	$(".dlgImportar").click(function() {
		var dlgDoContent = createDialog($(this).attr("href"), $(this).attr("title"));
		dlgDoContent.dialog({
			draggable: false,
			width: 350,
			resizable: false,
			position: { at: 'center top' },
			buttons: {
				"Importar": function() {
					submitFormOrCloseDialog(this);
				}
			},
			close: function(){
				$(this).remove();
			}
		});	
		return false;
	});
}
function loadDlgVerPequeno() {
	$(".dlgVerPequeno").click(function() {
		var dlgDoContent = createDialog($(this).attr("href"), $(this).attr("title"));
		dlgDoContent.dialog({
			draggable: false,
			width: 200,
			resizable: false,
			position: { at: 'center top' },
			close: function(){
				$(this).remove();
			}
		});	
		return false;
	});
}
function loadDlgVerPadrao() {
	$(".dlgVerPadrao").click(function() {
		var dlgDoContent = createDialog($(this).attr("href"), $(this).attr("title"));
		dlgDoContent.dialog({
			draggable: false,
			width: 350,
			resizable: false,
			position: { at: 'center top' },
			close: function(){
				$(this).remove();
			}
		});	
		return false;
	});
}
function loadDlgCadastrarPequeno() {
	$(".dlgCadastrarPequeno").click(function() {
		var dlgDoContent = createDialog($(this).attr("href"), $(this).attr("title"));
		dlgDoContent.dialog({
			draggable: false,
			width: 200,
			modal: true,
			resizable: false,
			position: { at: 'center top' },
			buttons: {
				"Cadastrar": function() {
					submitFormOrCloseDialog(this);
				}
			},
			close: function(){
				$(this).remove();
			}
		});	
		return false;
	});
}
function loadDlgEditarPequeno() {
	$(".dlgEditarPequeno").click(function() {
		var dlgDoContent = createDialog($(this).attr("href"), $(this).attr("title"));
		dlgDoContent.dialog({
			draggable: false,
			width: 200,
			modal: true,
			resizable: false,
			position: { at: 'center top' },
			buttons: {
				"Atualizar": function() {
					submitFormOrCloseDialog(this);
				}
			}
		});	
		return false;
	});
}
function loadDlgGrande() {
	$(".dlgGrande").click(function() {
		location.hash = $(this).attr('id');
		var dlgDoContent = createDialog($(this).attr("href"), $(this).attr("title"));
		dlgDoContent.dialog({
			draggable: false,
			width: 450,
			modal: true,
			resizable: false,
			position: { at: 'center top' },
			close: function(){
				loadAjaxSendForms(dlgDoContent);
				location.hash = '';
				$(this).remove();
			}
		});
		return false;
	});
	$(location.hash).click();
}
function loadDlgEditarPadrao() {
	$(".dlgEditarPadrao").click(function() {
		var dlgDoContent = createDialog($(this).attr("href"), $(this).attr("title"));
		dlgDoContent.dialog({
			draggable: false,
			width: 350,
			modal: true,
			resizable: false,
			position: { at: 'center top' },
			buttons: {
				"Atualizar": function() {
					submitFormOrCloseDialog(this);
				}
			},
			close: function(){
				$(this).remove();
			}
		});	
		return false;
	});
}
function loadDlgAdicionarPadrao() {
	$(".dlgAdicionarPadrao").click(function() {
		var dlgDoContent = createDialog($(this).attr("href"), $(this).attr("title"));
		dlgDoContent.dialog({
			draggable: false,
			width: 350,
			modal: true,
			resizable: false,
			position: { at: 'center top' },
			buttons: {
				"Adicionar": function() {
					submitFormOrCloseDialog(this);
				}
			}
		});	
		return false;
	});
}
function loadDlgCadastrarPadrao() {
	$(".dlgCadastrarPadrao").click(function() {
		var dlgDoContent = createDialog($(this).attr("href"), $(this).attr("title"));
		dlgDoContent.dialog({
			draggable: false,
			width: 350,
			modal: true,
			resizable: false,
			position: { at: 'center top' },
			buttons: {
				"Cadastrar": function() {
					submitFormOrCloseDialog(this);
				}
			}
		});	
		return false;
	});
}

// #############################################################################
// Métodos base ################################################################
function loadAjaxDialogForm(selector) {
	var target = $(selector).closest('.ui-dialog-content');
	$(selector).ajaxForm({
		beforeSerialize: function() {
			updateCkeditorInstances(target);
		},
		beforeSubmit: function() {
			target.html(loadingstr);
		},
		success: function(data) {
			target.html(data);
		}
	});
}
function createDialog(href, title) {
	var cleanUrl = href.replace(cleanregex, "_").slice(1);
	var dlgId = cleanUrl.toLowerCase();
	var target = '#'+dlgId;

	var dlgDoContent;
	if($(target).length > 0) {
		dlgDoContent = $(target);
		dlgDoContent.dialog("open");
	} 
	else {
		dlgDoContent = $("<div></div>");
		dlgDoContent.attr("id", dlgId);
		dlgDoContent.attr("title", title);

		$("body").append(dlgDoContent);
		loadAjaxLink(target, href);
	}

	return dlgDoContent;
}
function submitFormOrCloseDialog(obj) {
	if($(obj).parent().find('form').length > 0) {
		$(obj).parent().find('form').submit(); 
	}
	else {
		$(obj).dialog('close');
	}
}
	