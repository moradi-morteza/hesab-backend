module.exports = {
    methods: {
        convertNumbers2English: function (string) {
            return string.replace(/[\u0660-\u0669]/g, function (c) {
                return c.charCodeAt(0) - 0x0660;
            }).replace(/[\u06f0-\u06f9]/g, function (c) {
                return c.charCodeAt(0) - 0x06f0;
            });
        },
        persianDateStringToArrayNumber(date){
            return  this.convertNumbers2English(date).split("/").map(str => Number(str))

        },
        getPersianDateStringUnix(date){
            // date should be like : "1401/3/2" and this function return "1653291000000"
            let array = this.persianDateStringToArrayNumber(date);
            console.log(array);
            array.push(12)
            array.push(0)
            array.push(0)
            array.push(0)
            return new persianDate(array).valueOf()
        },
        checkDateIsBetweenOrSameDates(dateUnix, startUnix, endUnix){
            console.log(dateUnix)
            console.log(startUnix)
            console.log(endUnix)
            if (startUnix===endUnix){
                return dateUnix===startUnix;
            }else{
                return dateUnix >= startUnix && dateUnix <= endUnix;
            }
        },
        searchInDataTable(search,object,headObject){
            if (search===''){
                return  true;
            }
            let result = false
            Object.keys(headObject).forEach(headKey=>{
                if (headObject[headKey].isSearchAble){
                    if (object[headKey].toString().indexOf(search) > -1){
                        result =  true;
                    }
                }
            })
            return result;
        }
    }
}
