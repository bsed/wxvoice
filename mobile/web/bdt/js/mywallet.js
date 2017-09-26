var userTest = "";
var getSysParams = "";
$(document).ready(function() {
    var price = $('.wei').text();
    if(price < '1.00'){
        $('.can').text('不能提现');
        return false;
    }
    $(".can").click(function(){
			tixian(price);
    });

});

function tixian(price){
    dataLoading("申请提交中...");
    var csrf = $('input[name="csrf"]').val();
    $.ajax({
        type: "POST",
        url: "/members/tixian.html",
        data: {
            price:price,
            _csrf:csrf,
        },
        dataType: "json",
        success: function(data){
            if(data.result == "success"){
                dataLoadedSuccess("提交成功");
                window.location.href = '/members/index.html'
            }
        }
    });
}
