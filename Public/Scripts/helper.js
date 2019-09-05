

function is_json(json) {
    try {
        JSON.parse(json);
        return true;
    } catch (e) {
        return false;
    }
}


function get_pathname() {
    var pathname = window.location.pathname;
    pathname = pathname.replace('/', '');
    if (pathname !== "") {
        return pathname;
    } else {
        return "/";
    }
}

function getPos(element) {
    var rect = element.getBoundingClientRect();
    var x = rect.left;
    var y = rect.top;
    return {x: x, y: y};
}


function blockPage() {
    mApp.blockPage({
        overlayColor: "#4CAF50",
        type: "loader",
        state: "success",
        message: "Carregando..."
    });
}

function unblockPage() {
    mApp.unblockPage();
}

function blockElement(element) {
    mApp.block(element, {
        overlayColor: '"#4CAF50"',
        type: 'loader',
        state: 'primary',
        message: 'Carregando...'
    });

}
function unblockElement(element) {
    mApp.unblock(element);
}



function loadingBar(boolean) {
    if (boolean) {
        $("#my-page").addClass("animate_bar");
    } else {
        $("#my-page").removeClass("animate_bar");
    }
}

{
    var timeOut;
    function notify(msg, typeClass) {
        var alert = $("#system_alert");
        alert.addClass(typeClass);
        alert.html(msg);
        alert.show();
        timeOut = setTimeout(function () {
            alert.hide();
            alert.removeClass(typeClass);
        }, 5000);
    }

    function hideNotify() {
        clearTimeout(timeOut);
        var alert = $("#system_alert");
        alert.hide();
    }
}

/**
 * Função usada para ler a resposta
 * do servidor.
 * Possui um callback opcional
 * @param {type} response
 * @param {type} callback
 * @return {undefined}
 */
function lerResposta(response, callback) {
    if (is_json(response)) {
        var data = JSON.parse(response);
        if (data.result) {
            if (typeof callback === 'function' && callback()) {
                callback();
            }
            notify(data.message, 'alert-success');
        } else {
            unblockPage();
            notify(data.message, 'alert-danger');
        }
        return data.result;
    } else {
        unblockPage();
        notify("Resposta inesperada do servidor", 'alert-danger');
        return false;
    }
}
