document.addEventListener('DOMContentLoaded', () => {

    const textedJson = JSON.stringify(myDatas, undefined, 4);


    console.log(textedJson);
    // console.log(myDatas)

    const obj = JSON.parse(myDatas, (key, value) => {
        // console.log(key)
        // console.log(value.CrystalSuiteDataSource)
    });

})