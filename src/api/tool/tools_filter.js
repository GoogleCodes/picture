//  创建goToFilter类
export default new class goToFilter {
    changePrice(value) {
        return "￥" + value.toFixed(2);
    }
    //  过滤时间戳
    goTime(value) {
        let d = new Date(parseInt(value) * 1000);
        let years = d.getFullYear(),
            month = d.getMonth() + 1, 
            days = d.getDate(), 
            hours = d.getHours(), 
            minutes = d.getMinutes(), 
            seconds = d.getSeconds();
        return years + "-" + month + "-" + days + " " + (hours > 9 ? hours : '0' + hours) + ':' + (minutes > 9 ? minutes : '0' + minutes);
    }
}