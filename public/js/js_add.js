window.onload = function(){
    fetchData();

 };


var touchDevice = ('ontouchstart' in document.documentElement);
let domin = window.location.hostname
let device = touchDevice ? "mobile" : "desktop"
var fixpost = document.getElementById("sorenad_fixpost");


function loadDoc2(data) {
    console.log(data )
    let url ="https://sorenad.runflare.run/api/test"
    // let url ="http://127.0.0.1:8000/api/test"
    let info = {
        domin: domin,
        device: device,
        ip: 1,
        fixpost: document.querySelectorAll("#sorenad_fixpost").length,
    }
    console.log(info)
    return new Promise((resolve, reject) => {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    resolve(JSON.parse(this.responseText));
                } else {
                    reject(new Error('Failed to fetch data from API +loadDoc2'));
                }
            }
        };
        xhttp.open("post",url);
        xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhttp.send(JSON.stringify(info));
    });
 }
function loadDoc1() {
    return 1
    // return new Promise((resolve, reject) => {
    //     const xhttp = new XMLHttpRequest();
    //     xhttp.onreadystatechange = function() {
    //         if (this.readyState == 4) {
    //             if (this.status == 200) {
    //                 resolve(JSON.parse(this.responseText));
    //             } else {
    //                 reject(new Error('Failed to fetch data from API'));
    //             }
    //         }
    //     };
    //     xhttp.open("GET", "https://api.db-ip.com/v2/free/self");
    //     xhttp.send();
    // });
}

async function fetchData() {
    try {
        // const data1 = await loadDoc1();
        // console.log("First operation completed with data:", data1);

     let res= await loadDoc2();
     console.log(res)
        if( res.status=="ok"){
            document.head.innerHTML += `<link rel="stylesheet" href="${res.css}" type="text/css"/>`;
        }
        if(device=="mobile" && res.app){
            console.log("app")
            setTimeout(() => {
                document.body.innerHTML += res.app;
                document.querySelector(".sorenad_close").addEventListener('click', function (e) {
                    this.closest(".sorenad_par").remove()
                })
            }, 200);
        }
        if( res.fixpost){
            console.log("fixpost")
            setTimeout(() => {
                document.getElementById("sorenad_fixpost").innerHTML = res.fixpost;

            }, 200);
        }
    } catch (error) {
        console.error(error);
    }
}

