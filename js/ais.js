async function requestDownload(asin){
    return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url: 'ajax.php',
            data: {asin},
            success: (resp) => resp == 'success' ? resolve() : reject(resp),
        });
    });
}

async function doJob(){
    const ASINs = getASINs();
    for (let i = 0; i < ASINs.length; i++){
        const asin = ASINs[i];
        try {
            await requestDownload(asin);
            downloadZip(asin);
        } catch (error) {
        }
        setProgress(calcProgress(ASINs.length, i + 1));
    }
}

function getASINs(){
    const raw = $('#asins').val();
    return raw.split("\n");
}

function calcProgress(total, current){
    return current / total * 100;
}


function downloadZip(asin){
    window.location.href = `zips/${asin}.zip`;
}

// ------------------------------------------------

$(document).ready(() => {
    $('#submit').on('click', submitClick)
})

let prog = 0;
async function submitClick() {
    setProgress(2);
    disableControlls();
    try {
        await doJob();
        setTimeout(() => {
            alert('Completed');
            setProgress(0);
        }, 500);
    } catch (error) {
        alert(error);
        setProgress(0);
    }
    enableControlls();
}


function disableControlls(){
    $("#submit").prop('disabled', true);
    $("#asins").prop('disabled', true);
}
function enableControlls(){
    $("#submit").prop('disabled', false);
    $("#asins").prop('disabled', false);
}

function setProgress(value){
    $('#progress').css({width: value + '%'});
}