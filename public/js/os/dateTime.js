function  localHostDateTime(){
    setInterval(function(){
        var timezone = 8;
        var offset_GMT = new Date().getTimezoneOffset(); // 本地时间和格林威治的时间差，单位为分钟
        var nowDate = new Date().getTime(); // 本地时间距 1970 年 1 月 1 日午夜（GMT 时间）之间的毫秒数
        var targetDate = new Date(nowDate + offset_GMT * 60 * 1000 + timezone * 60 * 60 * 1000);
        var year = targetDate.getFullYear();
        var month = targetDate.getMonth() + 1 < 10 ? "0" + (targetDate.getMonth() + 1) : targetDate.getMonth() + 1;
        var date = targetDate.getDate() < 10 ? "0" + targetDate.getDate() : targetDate.getDate();
        var hour = targetDate.getHours()< 10 ? "0" + targetDate.getHours() : targetDate.getHours();
        var minute = targetDate.getMinutes()< 10 ? "0" + targetDate.getMinutes() : targetDate.getMinutes();
        var second = targetDate.getSeconds()< 10 ? "0" + targetDate.getSeconds() : targetDate.getSeconds();
        var dateTime = year + "-" + month + "-" + date+" "+hour+":"+minute+":"+second;
        $('#time-zone').text(dateTime);
    }, 1000);


}

function hiddenHuiAlert() {
    setTimeout(function () {
        console.log("===");
        $(".Huialert").remove();
    }, 1000*2);
}