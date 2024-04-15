var touchDevice = ('ontouchstart' in document.documentElement);
let domin = window.location.hostname
let device = touchDevice ? "mobile" : "desktop"
var fixpost = document.getElementById("sorenad_fixpost");




async function fetchData() {
    try {
        const data1 = await loadDoc1();
        console.log("First operation completed with data:", data1);
        const rs=  await loadDoc2();
        console.log(re);
    } catch (error) {
        console.error(error);
    }
}

fetchData();
function loadDoc1() {
    return new Promise((resolve, reject) => {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    resolve(JSON.parse(this.responseText));
                } else {
                    reject(new Error('Failed to fetch data from API'));
                }
            }
        };
        xhttp.open("GET", "https://api.db-ip.com/v2/free/self");
        xhttp.send();
    });
}
function loadDoc2(){
    console.log("loadDoc2")
}


// fetch('https://api.db-ip.com/v2/free/self')
//   .then(function(response) {
//     console.log( response);
//     console.log( response.json());

//   })
//   .then(function(myJson) {
//     console.log(myJson);
//   });
let ip=null
function loadDoc() {
    return new Promise((resolve, reject) => {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    resolve(this.responseText);
                } else {
                    reject(new Error('Failed to fetch data'));
                }
            }
        };

        xhttp.open("GET", "https://api.db-ip.com/v2/free/self");
        xhttp.send();
    });
}

// Usage
loadDoc()
    .then(responseText => {
        ip=responseText
        console.log(responseText);
    })
    .catch(error => {
        console.error(error);
    });



let data = {
    domin: domin,
    device: device,
    ip: ip,
    fixpost: document.querySelectorAll("#sorenad_fixpost").length,
}
console.log(data)
let WebXmlHttpRequest=(method,url,data)=>{
    return new Promise((resolve,reject)=>{
        let xHttp=new XMLHttpRequest()
        xHttp.open(method,url)
        xHttp.responseType="json"
        if(data){
            xHttp.setRequestHeader("Content-Type","application/json")
        }
        xHttp.onload=()=>{
            resolve(xHttp.response)
        }
        xHttp.onerror=()=>{
            console.log(12222)
            console.log(xHttp.error)
            reject(xHttp.error)
        }
        xHttp.send(JSON.stringify(data))

    })

}
let url ="https://sorenad.runflare.run/api/test"
// let url ="http://127.0.0.1:8000/api/test"
function post(url){
    console.log(url)
    WebXmlHttpRequest("post",url,data).then(function(res){
        console.log(res)
        let css = res.css
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
    }).catch(function(err){
        console.log(err)
    })
}
window.onload = function(){
    post(url)

 };
// ajax()
console.log(12)
// console.log(url)
 function ajax(){
    $.ajax('http://127.0.0.1:8000/api/test', {
    headers: {
        // 'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
    },
    type: 'post',
    data: data,
    datatype: 'json',
    success: function (data) {
        console.log(data)
        // let css = data.css
        // document.head.innerHTML += `<link rel="stylesheet" href="${data.css}" type="text/css"/>`;
        // document.body.innerHTML += data.body;
        // document.querySelector(".sorenad_close").addEventListener('click', function (e) {
        //     this.closest(".sorenad_par").remove()
        // })

    },
    error: function (request, status, error) {
        console.log(request);
        console.log(status);
        console.log(error);
    }
})
}

