{
	complete: function () {
		$(this).attr('disabled', 'disabled');
	}
}

{
	complete: function () {
		$(this).removeAttr('disabled');
	}
}


ВАЖНО по UI, сокрытие <options> в Safari, IE и других непопулярных браузерах.

НЕ РАБОТАЕТ

$('option').hide();
$('option').show();

РАБОТАЕТ, но НЕ скрывает, а дисейблит

$('option').hide({
	complete: function () {
		$(this).attr('disabled', 'disabled');
	}
});
$('option').show({
	complete: function () {
		$(this).removeAttr('disabled');
	}
});

Если прям скрывать, то надо переписывать всё под DATA DRIVEN DEVELOPMENT - где рендеринг происходит на основе данных, а не вёрстки.