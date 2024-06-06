window.onload = function(){
    fetchData();

 };


var touchDevice = ('ontouchstart' in document.documentElement);
let domin = window.location.hostname
let device = touchDevice ? "mobile" : "desktop"
var fixpost = document.getElementById("sorenad_fixpost");
var banner = document.getElementById("sorenad_banner");
var banner2 = document.getElementById("sorenad_banner2");
var video = document.getElementById("sorenad_video");
var hamsan = document.getElementById("sorenad_hamsan");
var text = document.getElementById("sorenad_text");


function loadDoc2(data) {
    let  url ="https://sorenad.runflare.run/api/ads"
    if(window.location.hostname=="127.0.0.1"){

        url ="http://127.0.0.1:8000/api/ads"
    }
    console.log(url)
    // let url ="http://127.0.0.1:8000/api/test"
    let info = {
        domin: domin,
        device: device,
        ip: 1,
        fixpost: document.querySelectorAll("#sorenad_fixpost").length,
        banner: document.querySelectorAll("#sorenad_banner").length,
        banner2: document.querySelectorAll("#sorenad_banner2").length,
        video: document.querySelectorAll("#sorenad_video").length,
        hamsan: document.querySelectorAll("#sorenad_hamsan").length,
        text: document.querySelectorAll("#sorenad_text").length,
    }
    console.log(info)
    return new Promise((resolve, reject) => {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(oEvent) {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    resolve(JSON.parse(this.responseText));
                } else {
                    // reject(new Error(this.status));
                    reject(new Error(this.responseText));
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

function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
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
        if(res.popup){
            console.log("popup")
            setTimeout(() => {
                window.open(res.popup, "popupWindow", "width=600,height=600,scrollbars=yes,")
            }, 200);
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
                console.log("sorenad_fixpost")
                document.getElementById("sorenad_fixpost").innerHTML = res.fixpost;
            }, 200);
            setTimeout(() => {
                var element = document.getElementById('sorenad_fixpost');
                if (!isElementInViewport(element)) {
                    console.log("invisible")
                    var scrollDiv = document.getElementById("sorenad_fixpost").offsetTop;
window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
                }
            }, 2000);
        }
        if( res.banner){
            console.log("banner")
            setTimeout(() => {
                document.getElementById("sorenad_banner").innerHTML = res.banner;

            }, 200);
        }
        if( res.banner2){
            console.log("banner2")
            setTimeout(() => {
                document.getElementById("sorenad_banner2").innerHTML = res.banner2;

            }, 200);
        }
        if( res.video){
            console.log("video")
            setTimeout(() => {
                document.getElementById("sorenad_video").innerHTML = res.video;

            }, 200);
        }

        if( res.text){
            console.log("text")
            setTimeout(() => {
                document.getElementById("sorenad_text").innerHTML = res.text;

            }, 200);
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
        if( res.hamsan){
            console.log("hamsan")
            setTimeout(() => {
                document.body.innerHTML += res.hamsan;
                document.querySelector(".icon_soren").addEventListener('click', function (e) {
                    console.log(80)
                    this.classList.toggle("s_rotate");
                    this.closest('.ssoren_cont').querySelector(".soren_ad_hamsab").classList.toggle("sorenad_hams_down");
                })
            }, 200);
        }
    } catch (error) {
        console.error(error);
    }
}









