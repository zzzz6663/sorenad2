function noty(message, color = 'red', title = 'اخطار', position = 'topCenter', timeout = 5000) {
    iziToast.show({
        title: title,
        color: color,
        position: position,
        animateInside: true,
        rtl: true,
        message: message,
        titleSize: '25px',
        messageSize: '20px',
        timeout: timeout,
    });
}

function moving() {
    // console.log(622)
    // if($('.moving').length){
    //     setInterval( function(){
    // console.log(655)

    //         var currentLeft = parseFloat($('.moving').css('left'));
    //         currentLeft++;
    //         console.log(currentLeft);
    //         console.log( $('.ad_img').width() );

    //          $('.moving').css('left',currentLeft+'px');

    //         if (currentLeft > $('.ad_img').width() ){
    //          $('.moving').css('left','-200px');
    //         }
    //         else {
    //           $('.moving').css('left',currentLeft+'px');
    //         }
    //       }, 10);
    // }
}
function start_loading() {
    $('body').loadingModal({
        position: 'auto',
        text: '',
        color: '#fff',
        opacity: '0.7',
        backgroundColor: 'rgb(0,0,0)',
        animation: 'doubleBounce'
    });
}

function end_loading() {
    $('body').loadingModal('destroy');

}

function count_down() {
    var minute = 0;
    var sec = 59;
    let refreshIntervalId = setInterval(function () {
        document.getElementById("countdwon").innerHTML = sec;
        sec--;
        if (sec == 00) {
            document.querySelector('.resend_code').style.display = 'block';
            document.querySelector('.timeer').style.display = 'none';
            clearInterval(refreshIntervalId);
        }
    }, 1000);
}





function send_direct(chat, to_id,uni,first=null) {
    $('#send_direct').val("")
    console.log(chat)
    load_animation()
    $.ajax('/panel/send_direct/' + to_id, {
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
        },
        data: { chat: chat, to_id: to_id ,uni:uni, first: first  },
        type: 'post',
        cache: false,
        success: function (data) {
            stop_animation()
            console.log(data)

        },
        error: function (request, status, error) {
            console.log(request)
            stop_animation()

            noty('         ارتباط قطع است ', 'red', '');
        }
    })
}

function send_chat(id, chat, visitor_id, first, uni) {
    $('#send_chat').val("")
    load_animation()
    $.ajax('/panel/send_chat/' + id, {
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
        },
        data: { chat: chat, visitor_id: visitor_id, first: first, uni: uni },
        type: 'post',
        cache: false,
        success: function (data) {
            stop_animation()
            console.log(data)

        },
        error: function (request, status, error) {
            console.log(request)
            stop_animation()

            noty('         ارتباط قطع است ', 'red', '');
        }
    })
}
function load_recaptcha() {
    $('#captcha').val('')
    $.ajax('/reload_captcha', {
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
            // 'Content-Type':'application/json,charset=utf-8'
        },
        type: 'post',
        success: function (data) {
            // console.log(data);
            $('.reload_captcha').closest('.capt').find('.img_par').empty()
            $('.reload_captcha').closest('.capt').find('.img_par').append(data.captcha)

        },
        error: function (request, status, error) {
            console.log(error);
        }
    })
}
function stop_animation() {
    if ($('.modal-mask').length) {
        $('.modal-mask').remove()
    }
}
function load_animation() {
    var loading = new Loading({

        // 'ver' or 'hor'
        direction: 'ver',

        // loading title
        title: 'در حال پردازش اطلاعات',

        // text color
        titleColor: '#FFF',

        // font size
        titleFontSize: 14,

        // extra class(es)
        titleClassName: undefined,

        // font family
        titleFontFamily: undefined,

        // loading description
        discription: 'لطفا صبر گنید',

        // text color
        discriptionColor: '#FFF',

        // font size
        discriptionFontSize: 14,

        // extra class(es)
        discriptionClassName: undefined,

        // font family
        directionFontFamily: undefined,

        // width/height of loading indicator
        loadingWidth: 'auto',
        loadingHeight: 'auto',

        // padding in pixels
        loadingPadding: 20,

        // background color
        loadingBgColor: '#252525',

        // border radius in pixels
        loadingBorderRadius: 12,

        // loading position
        loadingPosition: 'fixed',

        // shows/hides background overlay
        mask: true,

        // background color
        maskBgColor: 'rgba(0, 0, 0, .6)',

        // extra class(es)
        maskClassName: undefined,

        // mask position
        maskPosition: 'fixed',

        // 'image': use a custom image

        // path to loading spinner
        animationSrc: undefined,

        // width/height of loading spinner
        animationWidth: 40,
        animationHeight: 40,
        animationOriginWidth: 4,
        animationOriginHeight: 4,

        // color
        animationOriginColor: '#FFF',

        // extra class(es)
        animationClassName: undefined,

        // auto display
        defaultApply: true,

        // animation options
        animationIn: 'animated fadeIn',
        animationOut: 'animated fadeOut',
        animationDuration: 1000,

        // z-index property
        zIndex: 0,

    });
}



function echo_direct(el ) {
    let id = el.data('id')
    let uni = el.data('uni')
    let user = el.data('user')
    let current = el.data('current')
    let all = []
    window.Echo.join('direct_messaage.'+uni)
        .here(users => {
            users.forEach(function (item) {
            });
        })
        .joining(user => {
            console.log('joining')
        })
        .leaving(user => {
            console.log('leaving')
        })
        .listen('DirectMessage', e => {
            console.log(e)
            done = "";
            show_class = "left";
            if (current == e.info.sender_user) {
                done = "done "
                show_class = "right";
                console.log("self")
            }else{
                console.log(e.info.id)
                console.log(uni)
                console.log("other")
                $.ajax('/panel/check_seen', {
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    },
                    data: { id: e.info.id },
                    type: 'post',
                    success: function (data) {
                        console.log(data)
                    },
                    error: function (request, status, error) {
                        console.log(request)
                    }
                })
            }
            if (e.info.uni == uni ) {
                $('.room').append(
                    `
                            <div class="chat-boxe ${show_class}" id="chat_cl_${e.info.id}">
                                <div class="img">
                                <img src="${e.info.avatar}" alt="">
                                </div>
                                <div class="chat ${show_class}">
                                    <div class="text">
                                    ${e.info.chat}
                                    <span class="material-icons ">
                                        ${done}
                                    </span>
                                        <span class="time">
                                        ${e.info.date}
                                        </span>
                                    </div>
                                </div>
                              </div>
                            `
                )
                $(".room").animate({ scrollTop: $('.room').prop("scrollHeight") }, 1000);
                check_seen(e,user)
            }

            $(".room").animate({ scrollTop: $('.room').prop("scrollHeight") }, 1000);

        }).listenForWhisper('typing', e => {
            console.log(e)
            $('#direct_' + e.uni).text(" is typing...")
            console.log("is typing")
            // console.log(e.show)
            if (e.show) {
                clearTimeout(time)
            }
            let time = setTimeout(() => {
                $('#direct_' + e.uni).text("")
                e.show = false
            }, 3000);
        })
    $(".room").animate({ scrollTop: $('.room').prop("scrollHeight") }, 1000);
}
function echo_direct2(el, show = false) {
    let uni = el.data('uni')
    console.log(uni)
    let current = el.data('current')
    let all = []
    window.Echo.join('direct_messaage.'+uni )
        .here(users => {
            console.log('hear')
            console.log(users)
            // console.log(users)
            users.forEach(function (item) {
                console.log(item)
                $('#user_d_' + item.user.id).removeClass('uoffline')
                $('#user_d_' + item.user.id).addClass('uonline')
                all.push(item.user.id);
            });
        })
        .joining(user => {
            console.log('joining')
            console.log(user)
            $('#user_d_' + user.user.id).removeClass('uoffline')
            $('#user_d_' + user.user.id).addClass('uonline')
        })
        .leaving(user => {
            console.log('leaving')
            $('#user_d_' + user.user.id).removeClass('uonline')
            $('#user_d_' + user.user.id).addClass('uoffline')
        })

}
function echo_ad1(el, show = false) {
    let uni = el.data('uni')
    console.log(uni)
    let current = el.data('current')
    let all = []
    window.Echo.join('new_messaage.' + uni)
        .here(users => {
            // console.log('hear')
            // console.log(users)
            users.forEach(function (item) {
                console.log(item)
                // console.log(item)
                $('#user_' + item.user.id).removeClass('uoffline')
                $('#user_' + item.user.id).addClass('uonline')
                all.push(item.user.id);
            });
        })
        .joining(user => {
            console.log('joining')
            $('#user_' + user.user.id).removeClass('uoffline')
            $('#user_' + user.user.id).addClass('uonline')
        })
        .leaving(user => {
            console.log('leaving')
            $('#user_' + user.user.id).removeClass('uonline')
            $('#user_' + user.user.id).addClass('uoffline')
        })

}


function echo_ad(el, show = false) {
    let uni = el.data('uni')
    let user = el.data('current')
    console.log(uni)
    let current = el.data('current')
    let all = []
    window.Echo.join('new_messaage.' + uni)
        .here(users => {
            // console.log('hear')
            // console.log(users)
            users.forEach(function (item) {
                // console.log(item)
                $('#user_' + item.user.id).removeClass('uoffline')
                $('#user_' + item.user.id).addClass('uonline')
                all.push(item.user.id);
            });
        })
        .joining(user => {
            console.log('joining')
            $('#user_' + user.user.id).removeClass('uoffline')
            $('#user_' + user.user.id).addClass('uonline')
        })
        .leaving(user => {
            console.log('leaving')
            $('#user_' + user.user.id).removeClass('uonline')
            $('#user_' + user.user.id).addClass('uoffline')
        })
        .listen('NewMessage', e => {
            console.log(e)
            done = "";
            show_class = "left";
            if (current == e.info.sender_user) {
                done = "done "
                show_class = "right";
                console.log("self")
            }else{
                console.log(e.info.id)
                console.log(uni)
                console.log("other")
                $.ajax('/panel/check_seen', {
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    },
                    data: { id: e.info.id },
                    type: 'post',
                    success: function (data) {
                        console.log(data)
                    },
                    error: function (request, status, error) {
                        console.log(request)
                    }
                })
            }
            if (e.info.uni == uni && show) {
                $('.room').append(
                    `
                            <div class="chat-boxe ${show_class}" id="chat_cl_${e.info.id}">
                                <div class="img">
                                <img src="${e.info.avatar}" alt="">
                                </div>
                                <div class="chat ${show_class}">
                                    <div class="text">
                                    ${e.info.chat}
                                    <span class="material-icons ">
                                        ${done}
                                    </span>
                                        <span class="time">
                                        ${e.info.date}
                                        </span>
                                    </div>
                                </div>
                              </div>
                            `
                )
                $(".room").animate({ scrollTop: $('.room').prop("scrollHeight") }, 1000);
                 check_seen(e,user)

            }

        }).listenForWhisper('typing', e => {
            if(show){
                $('#type_' + e.uni).text(" is typing...")
                if (e.show) {
                    clearTimeout(time)
                }
                let time = setTimeout(() => {
                    $('#type_' + e.uni).text("")
                    e.show = false
                }, 3000);
            }

        })
    $(".room").animate({ scrollTop: $('.room').prop("scrollHeight") }, 1000);



        console.log("seen_message")


}

function check_seen(e,user){
    window.Echo.join('seen_message' )
    .here(users => {
        console.log("hear")
    })
    .joining(user => {
        console.log('joining')

    })
    .leaving(user => {
        console.log('leaving')

    })      .listen('SeenMessage', e => {
        console.log(e)
        console.log(user)
        if(e.info.sender==user){
            $('#chat_cl_'+e.info.id).find(".material-icons").text("done_all")
        }
    })
}

window.onload = function () {
    if (window.jQuery) {
        moving()
        window.onhashchange = function () {
            // console.log("backkkkkkkkkk")
        }
        // if (document.hasFocus()){
        //     console.log('Tab is active1111')
        // }
        // console.log((6000000).num2persian())
        let vals = JSON.stringify(localStorage);
        let add = localStorage
        console.log(localStorage)
        Object.keys(localStorage); // ['One', 'Two', 'Three']
        // Object.keys(localStorage).forEach(key => console.log(key))
        Object.keys(add); // ['One', 'Two', 'Three']
        data = {}

        Object.keys(add).forEach(key => {
            if (key != "pusherTransportTLS") {
                console.log(key)
                console.log(add[key])

                data[key] = add[key]
                // data= {'_method':'get','type':'category',category:category};
            }

        })
        if ($('#ad_li').length) {
            update_ad_list(data)

        }



        //    if(vals){

        //     for(var key in localStorage) {

        //         if (key!="pusherTransportTLS") {
        //             console.log(  key)
        //             console.log(  localStorage.key)
        //         }
        //     }
        //    }

        // $('body').backDetect(function(){
        //     // Callback function
        //     console.log(162)
        //   });
        // window.onpopstate = function() {
        //     console.log(622)
        //     // if($('#ids_li').length){
        //     //     var form_data = $('#req_form').serializeArray();
        //     //     console.log(form_data)
        //     //     localStorage.setItem("form_data", form_data);
        //     //     console.log(localStorage.getItem("local"))
        //     //     form_data =ArrayToObject(form_data)
        //     //     console.log(form_data)
        //     //     update_ad_list(form_data)
        //     // console.log(7520)

        //     // }
        //  }; history.pushState({}, '');



        if ($('.get_direct').length) {
            $('.get_direct').each(function (i, obj) {
                // let id=obj.data('id')
                let el = $(this)
               echo_direct2(el)
            });


        }

        if ($('.get_chat').length) {
            $('.get_chat').each(function (i, obj) {
                let el = $(this)
                echo_ad1(el)
            });
        }

        $(document).on('keypress', '#send_chat', function (event) {

            let el = $(this)
            let uni = el.data('id')
            let name = el.data('name')
            console.log(uni)
            // console.log('new_messaage.'+id)
            window.Echo.join('new_messaage.' + uni).whisper('typing', {
                name: name,
                uni: uni,
                show: false
            })
        })


        $(document).on('keypress', '#send_direct', function (event) {

            let el = $(this)
            let uni = el.data('uni')
            let name = el.data('name')
            console.log(uni)
            // console.log('new_messaage.'+id)
            window.Echo.join('direct_messaage.' + uni).whisper('typing', {
                name: name,
                uni: uni,
                show: false
            })
        })


        $('.get_chat').click(function () {
            let el = $(this)
            $('.get_direct').removeClass("li_active")
            $('.get_chat').removeClass("li_active")
            el.addClass("li_active")
            let id = el.data('id')
            let uni = el.data('uni')
            let user = el.data('user')
            let visitor = el.data('visitor')
            load_animation()
            $.ajax('/panel/get_chat', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                data: { user: user, visitor: visitor, uni: uni },
                type: 'post',
                success: function (data) {
                    stop_animation()
                    // console.log(data)
                    $('#chat_box').html(data.body)
                    $(".room").animate({ scrollTop: $('.room').prop("scrollHeight") }, 1000);

                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })
             echo_ad(el,true)
        })

        $(document).on('click', '.send_chat', function () {
            let el = $(this)
            let id = el.data('id')
            let first = el.data('first')
            let uni = el.data('uni')
            let visitor_id = el.data('visitor')
            let chat = $('#send_chat').val()
            if (!chat.length) {
                noty("لطفا پیام خود را بنویسید")
            }
            console.log("sended")
            console.log(first)

            send_chat(id, chat, visitor_id, first, uni)
        })


        $(document).on('click', '.send_direct', function () {
            let el = $(this)
            let to_id = el.data('to')
            let first = el.data('first')
            let uni = el.data('uni')
            let chat = $('#send_direct').val()
            console.log(chat)
            send_direct(chat, to_id,uni,first)
            if($('#direct_modal').length){
                noty("پیام ارسال شد ","green","پیام")
            }
        })






        $('.get_direct').click(function () {
            let el = $(this)
            let to = el.data('to')
            let uni = el.data('uni')
            $('.get_chat').removeClass("li_active")
            $('.get_direct').removeClass("li_active")
            el.addClass("li_active")
            console.log(455)
            console.log(to)
            load_animation()
            $.ajax('/panel/get_direct', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                data: { to: to ,uni:uni},
                type: 'post',
                success: function (data) {
                    stop_animation()
                    // console.log(data)
                    $('#chat_box').html(data.body)
                    $(".room").animate({ scrollTop: $('.room').prop("scrollHeight") }, 1000);

                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })

            echo_direct(el)

        })



































        $(document).on('click', '.new_note', function (event) {
            noty("ثبت شد ", "green", "")
        });
        $(document).on('change', '.city_option', function (event) {
            let el = $(this)
            let name = el.data("name")
            let id = el.data("id")

            if (el.is(":checked")) {
                let city = `
                <span class="applied-filter gray pary" id="lable__${id}" >
                <input type="text" value="${id}"  name="cities[]" hidden id="">
                <span>${name}</span>
                <span class="remove-fil remove_all_ci" data-id="${id}" >
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20ZM10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18ZM10 8.586L12.1206 6.46462C12.5113 6.07383 13.1448 6.07378 13.5355 6.4645C13.9262 6.85522 13.9262 7.48872 13.5354 7.87937L11.414 10L13.5354 12.1206C13.9262 12.5113 13.9262 13.1448 13.5355 13.5355C13.1448 13.9262 12.5113 13.9262 12.1206 13.5354L10 11.414L7.87937 13.5354C7.48872 13.9262 6.85522 13.9262 6.4645 13.5355C6.07378 13.1448 6.07383 12.5113 6.46463 12.1206L8.586 10L6.46462 7.87937C6.07383 7.48872 6.07378 6.85522 6.4645 6.4645C6.85522 6.07378 7.48872 6.07383 7.87937 6.46463L10 8.586Z"
                            fill="currentColor"></path>
                    </svg>
                </span>
            </span>
            `
                $('#city_box').append(city)
            } else {
                $('#lable__' + id).remove() // Checks it

            }


        });
        $(document).on('click', '.icon_clo', function (event) {
            $('#search_city').val("")
            $.ajax('/get_province_list', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                type: 'post',
                success: function (data) {
                    console.log(data)
                    $('.proli_all').html(data.body)
                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })

        });
        $(document).on('keyup , change ', '#search_city', function (event) {
            let el = $(this);
            let val = el.val()
            if (!val) {
                $('.icon_clo').click()
            } else {
                $.ajax('/get_city_list', {
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    },
                    data: { val: val },
                    type: 'post',
                    success: function (data) {
                        console.log(data)
                        $('.proli_all').html(data.body)
                    },
                    error: function (request, status, error) {
                        console.log(request)
                    }
                })
            }


        });
        $(document).on('click', '#city_form_can', function (event) {
            let el = $(this);
            el.closest('.modal ').css('display', 'none')
        });
        $(document).on('click', '#city_form_btn', function (event) {
            console.log(60)

            $('#city_form').submit()
        });
        $(document).on('click', '.remove_all_ci', function (event) {
            let el = $(this);
            let id = el.data("id");
            el.closest(".pary").remove()

            console.log(id)
            $('#city__' + id).prop('checked', false); // Checks it
        });
        // $('.number_format').keyup(function () {
        //     let el = $(this);
        //     let val = el.val();
        //     console.log(60)
        //     if (val > 0) {
        //         let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        //         console.log(num)
        //         val = val.num2persian()
        //         if (el.closest('.col-12').find('.green_label').length) {
        //             console.log(80)
        //             console.log(num)
        //             el.closest('.col-12').find('.green_label').html(val + " تومان" + num)
        //             el.closest('.col-12').find('.yellow_label').html(num + " تومان" + num)
        //         } else {
        //             console.log(70)
        //             console.log(num)
        //             el.closest('.col-12').append(`
        //             <p class="yellow_label badge badge-success">
        //             ${num}
        //             </p>
        //             <p class="green_label badge badge-success">  ${val} -     ${num}
        //             تومان</p>
        //             `)
        //         }

        //     }
        // })













        if ($('.deposit_sec_li').length) {
            let index = Cookies.get('index') // => undefined
            console.log("index" + index)
            $(".deposit_sec_li").children().eq(index).click();


        }
        $(document).on('click', '.deposit_sec_li', function (event) {
            let el = $(this)
            let index = el.index();
            Cookies.set('index', index)
            console.log("index111" + index)

        })

        $(document).on('click', '.accord-box .top .toggle', function (event) {
            console.log('s')
            $(this).parent().parent('.accord-box').toggleClass('active');
        })


        $(document).on('click', '.sec1 .top .toggle', function (event) {
            console.log('s')
            $(this).parent().parent('.sec1').toggleClass('active');
        })

        $('.pay_from_cash').change(function () {
            let el = $(this)
            let amount = el.data('amount')
            let balance = el.data('balance')
            console.log(amount)
            console.log(balance)

            if (el.is(':checked')) {
                if (balance > amount) {
                    el.closest("form").find('.res_pay').text(0)
                } else {
                    el.closest("form").find('.res_pay').text((amount - balance).toLocaleString())
                }
            } else {
                el.closest("form").find('.res_pay').text(amount.toLocaleString())
                // $('.res_pay').text($.number( amount))
            }
        })

        $(document).on('click', '.province_parent', function (event) {
            let el = $(this);
            $('.province_parent').removeClass("active")
            setTimeout(() => {
                el.addClass("active")
            }, 200);
            setTimeout(() => {
                $('#c_selecr').scrollTop($('#c_selecr').scrollTop() + (el.position().top - $('#c_selecr').position().top) - ($('#c_selecr').height() / 2) + (el.height() / 2))

                // $('#c_selecr').animate({
                //     scrollTop: el.offset().top-100
                // }, 2000);

            }, 400);
        })
        $(document).on('click', '#select_region', function (event) {
            $('#city_all_select').show(400)
        })
        $(document).on('keyup', '.number_format', function (event) {
            let el = $(this);
            let val = el.val();
            let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
            console.log(60)
            if (val > 0) {
                val = val.num2persian()
                if (el.closest('.input-label').find('.green_label').length) {
                    el.closest('.input-label').find('.green_label').html(" ( " + num + " ) " + " - " + val + "  تومان ")
                } else {
                    el.closest('.input-label').append(`
                    <p class="green_label">  ${val} - ${num}
                    تومان</p>
                    `)
                }

            }
        })
        $('.amount_zero').focus(function () {
            let el = $(this);
            let val = el.val();

            if (val == 0) {
                el.val('')
            }
        })
        $('.send_deposit').click(function () {

            let val = $('#deposit_amount').val();
            let price = $('#price').data("price");
            val = Number(val)
            price = Number(price)
            console.log(val)
            console.log(price)

            let deposit_day = $('#deposit_day').val();
            // let deposit_min = $('#deposit_min').val();
            // let deposit_hour = $('#deposit_hour').val();
            // let deposit_day = $('#deposit_day').val();
            // if (!val || val == 0) {
            //     Swal.fire('    مبلغ وارد شده باید مضربی از هزار باشد ');
            //     return
            // }
            // if (val > price) {
            //     Swal.fire('    مبلغ وارد شده باید کمتر از مبلغ آگهی   باشد ');
            //     return
            // }
            // if (!deposit_min || !deposit_hour || !deposit_day) {
            //     Swal.fire('    لطفا زمان رو به درستی انتخاب کنید ');
            //     return
            // }
            // if (!deposit_min || !deposit_hour || !deposit_day) {
            //     Swal.fire('    لطفا زمان رو به درستی انتخاب کنید ');
            //     return
            // }
            if (!deposit_day) {
                Swal.fire('    لطفا زمان رو به درستی انتخاب کنید ');
                return
            }
            $('#deposit_form').submit()
        })
        $('.charge_wallet').click(function () {
            let val = $('#wallet_amount').val();
            if (!val) {
                Swal.fire('    مبلغ وارد شده باید مضربی از هزار باشد ');
                return
            }
            $('#send_bill_form').submit()
        })
        $('.send_deposit_pop').click(function () {
            $('#prepay-offer').show(400)

        })
        $('.final_res').click(function () {
            let el = $(this)
            let telic = el.data('id')
            get_telic(el, telic)
        });

        function get_telic(el, telic, update = true) {
            console.log('telic' + telic)
            data = { '_method': 'get', 'type': 'telic', telic: telic };
            if (update) {
                update_ad_list(data)

            }
            let type = el.data('type')
            let id = el.data('id')
            $.ajax('/filters', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                data: { id: id, type: type },
                type: 'post',
                success: function (data) {
                    console.log(data)
                    console.log(80)
                    $('#filters_all').html(data.body)
                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })
        }
        $('.subset_side').click(function () {
            let el = $(this)
            let subset = el.data('id')
            $('#filters_all').html("")
            localStorage.removeItem("telic")
            get_subset(el, subset, update = true)
        });

        function get_subset(el, subset, update = true) {
            // console.log('subset' + subset)
            data = { '_method': 'get', 'type': 'subset', subset: subset };
            if (update) {
                update_ad_list(data)
            }
            $('.par_sub').addClass('dis_none')
            el.closest('.par_sub').removeClass('dis_none')
            el.closest('.par_sub').find('.telic-list-item').removeClass('dis_none')

        }



        $(document).on('click', '.check_fave', function (event) {
            let el = $(this)
            let id = el.data('id')
            $.ajax('/check_fave/' + id, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                type: 'post',
                success: function (data) {
                    console.log(data)
                    if (data.status == '1') {
                        el.addClass('active')
                    } else {
                        el.removeClass('active')
                    }
                //    location.href=href;
                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })
        })

        $('body').on('click', '.go_ad', function (event) {
            let el =$(this)
            href=el.attr("href")
            event.stopPropagation();
            event.preventDefault()

           if($(event.target).hasClass('fave_f')){
            let id =    $(event.target).data('id')
            $.ajax('/check_fave/' + id, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                type: 'post',
                success: function (data) {
                    console.log(data)
                    if (data.status == '1') {
                        $(event.target).addClass('active')
                        $(event.target).closest(".check_fave").addClass('active')
                    } else {
                        $(event.target).removeClass('active')
                        $(event.target).closest(".check_fave").removeClass('active')

                    }
                //    location.href=href;
                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })
           }else{
           location.href=href;
           }


            // window.location.replace(href);



        });
        $('body').on('click', '.all_cat_show', function (e) {
            console.log(12);
            data = { '_method': 'get', 'type': 'category', "remove": 1 };
            update_ad_list(data)
            $('.accord-box.side_cat').each(function (i, obj) {
                let pl = $(this)
                pl.removeClass('active')
                pl.removeClass('d_none')
            });
            $('#search_box').val("")

        });

        // $('body').on('click', '.accord-box', function (e) {
        //     console.log(12);
        //     // data = { '_method': 'get', 'type': 'category', "remove": 1 };
        //     // update_ad_list(data)
        //     // $('.accord-box.side_cat').each(function (i, obj) {
        //     //     let pl = $(this)
        //     //     pl.removeClass('active')
        //     //     pl.removeClass('d_none')
        //     // });
        //     // $('#search_box').val("")

        // });


        $('body').on('keyup change', '.filter_class', function (e) {
            let el = $(this)
            let name = el.attr('name')
            let val = el.val()
            var form_data = $('#req_form').serializeArray();
            console.log(form_data)
            let ob = {}
            ob.name = name;
            ob.value = val;
            form_data.push(ob);
            // console.log(name)
            localStorage.setItem("form_data", form_data);
            console.log(localStorage.getItem("local"))
            // console.log(form_data)
            form_data = ArrayToObject(form_data)
            // console.log(form_data)
            update_ad_list(form_data, false)

        });
        function ArrayToObject(arr) {
            var obj = {};
            arr.forEach(function (item) {
                // console.log(item)
                obj[item.name] = item.value
            });
            return obj
        }

        $(document).on('change', '#city_id', function (event) {
            let el = $(this)
            let city_id = el.val()
            console.log(city_id)
            $.ajax('/get_region/' + city_id, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                type: 'post',
                success: function (data) {

                    console.log(data)
                    if (data.count > 0) {
                        $('#region_section').show(500);
                    } else {
                        $('#region_section').hide(500);
                    }
                    $('#region_id').html(data.body)
                    console.log("data_inject")

                    setTimeout(() => {
                        $('#region_id').niceSelect();
                        console.log("nice")
                    }, 2000);

                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })
        })
        $('body').on('change', '#province_id', function (e) {
            let el = $(this)
            let province = el.find(":selected").val();
            console.log(province)
            $.ajax('/get_city/' + province, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                type: 'post',
                success: function (data) {
                    console.log(data)
                    $('#city_id').html(data.body)
                    setTimeout(() => {
                        $('#city_id').niceSelect();
                    }, 500);
                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })
        });


        $('body').on('click', '.back_to_add', function (e) {
            event.preventDefault();
            let el = $(this)
            let id = el.data("id")
            let type = el.data("type")
            let page = 1
            let href = el.attr("href")
            localStorage.setItem("id", id);
            localStorage.setItem("type", type);
            localStorage.setItem("page", page);
            console.log(localStorage)
            window.location.href = "/ads"
        });


        $('body').on('click', '#page_ad a', function (e) {
            e.preventDefault();
            let el = $(this)
            let data = {}
            let query = el.attr('href').split('?')[1]
            let all_query = query.split('&')
            all_query.forEach(function (item) {
                let it = item.split('=')
                let name = it[0]
                let val = it[1]
                data[name] = val
            });
            update_ad_list(data)
        });


        function get_cat(id, type) {
            let all
            console.log(id);
            console.log(type);
            console.log(60555);
            $.ajax('/get_cat', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    // 'Content-Type':'application/json,charset=utf-8'
                },
                type: 'post',
                data: { id: id, type: type },
                datatype: 'json',
                async: false,
                success: function (data) {

                    console.log(data);
                    all = data;

                },
                error: function (request, status, error) {
                    console.log(request);
                    // stop_animation()
                    noty('       مشکلی ایجاد شده     ', 'red', '');
                }
            })
            return all
        }
        function update_ad_list(data, update = true) {
            load_animation()
            $.ajax('/ads', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    // 'Content-Type':'application/json,charset=utf-8'
                },
                type: 'get',
                datatype: 'json',
                data: data,
                success: function (data) {
                    stop_animation()
                    console.log(data);
                    if (!$('#ids_li').length) {
                        return
                    }
                    $('#ad_li').html(data.body)
                    console.log(localStorage)
                    let category
                    let subset
                    let telic
                    if (update) {
                        category = localStorage.getItem('category')
                        subset = localStorage.getItem('subset')
                        telic = localStorage.getItem('telic')
                    }


                    setTimeout(() => {
                        if (category) {
                            el = $(".toggle_ad[data-id='" + category + "']");
                            get_category(el, category, update = false)
                            console.log(category)
                        }
                    }, 200);
                    setTimeout(() => {
                        if (subset) {
                            let el = $('.subset_side').eq(subset - 1)
                            el = $(".subset_side[data-id='" + subset + "']");
                            get_subset(el, subset, update = false)
                            console.log(subset)
                        }
                    }, 200);
                    setTimeout(() => {
                        if (telic) {
                            let el = $('.final_res').eq(telic - 1)
                            el = $(".final_res[data-id='" + telic + "']");
                            get_telic(el, telic, update = false)
                            for (const key in localStorage) {
                                let val = localStorage[key]
                                if (key == "search") {
                                    if (val) {
                                        $('#search').addClass("active")
                                        $('#search_box').val(val)
                                    }
                                }
                                const myArray = key.split("__");
                                if (myArray.length > 1) {
                                    setTimeout(() => {
                                        let name = myArray[0]
                                        let inp = $("input[name=" + key + "]")
                                        if (val) {
                                            inp.closest('.accord-box ').addClass("active")
                                            inp.val(val)
                                        }
                                    }, 500);

                                }
                            }
                        }
                    }, 200);


                    // console.log(505050)
                    // console.log(505050)
                    // console.log(data.all)
                    // console.log(data.all.id)
                    setTimeout(() => {
                        if (data.all.id) {
                            $('.all_cat_show').click()

                            setTimeout(() => {
                                console.log(502)
                                console.log(localStorage)
                                console.log(data.all)
                                console.log(data.all.type)
                                if (data.all.type == "category") {
                                    let category = data.all.id
                                    el = $(".toggle_ad[data-id='" + category + "']");
                                    get_category(el, category, update = true)
                                }

                                if (data.all.type == "subset") {
                                    let subset = data.all.id
                                    let all_data = get_cat(subset, "subset")
                                    el = $(".toggle_ad[data-id='" + all_data.category + "']");
                                    get_category(el, all_data.category, update = true)
                                    setTimeout(() => {
                                        let el = $('.subset_side').eq(subset - 1)
                                        el = $(".subset_side[data-id='" + subset + "']");
                                        get_subset(el, subset, update = true)
                                    }, 20);
                                }
                                if (data.all.type == "telic") {
                                    let telic = data.all.id
                                    let all_data = get_cat(telic, "telic")
                                    el = $(".toggle_ad[data-id='" + all_data.category + "']");
                                    get_category(el, all_data.category, update = true)
                                    setTimeout(() => {
                                        let el = $('.subset_side').eq(all_data.subset - 1)
                                        el = $(".subset_side[data-id='" + all_data.subset + "']");
                                        get_subset(el, all_data.subset, update = true)
                                    }, 20);

                                    setTimeout(() => {
                                        let el = $('.final_res').eq(telic - 1)
                                        el = $(".final_res[data-id='" + telic + "']");
                                        get_telic(el, telic, update = true)
                                    }, 20);
                                }
                                // if(data.all.type=="category"){
                                //     let category= data.all.category
                                //     el = $(".toggle_ad[data-id='" + category + "']");
                                //     get_category(el, category, update = false)
                                // }
                                // if(data.all.type=="category"){
                                //     let category= data.all.category
                                //     el = $(".toggle_ad[data-id='" + category + "']");
                                //     get_category(el, category, update = false)
                                // }
                            }, 400);
                        }
                    }, 400);


                },
                error: function (request, status, error) {
                    stop_animation()
                    console.log(request);
                    // stop_animation()
                    noty('       مشکلی ایجاد شده     ', 'red', '');
                }
            })
        }

        $('.toggle_ad').click(function () {

            let el = $(this)
            let category = el.data('id')
            console.log(el)
            localStorage.removeItem('telic')
            localStorage.removeItem('subset')
            get_category(el, category, update = true)
            $('#filters_all').html("")
            $('#search_box').val("")
        })


        function get_category(el, category, update = true) {
            data = { '_method': 'get', 'type': 'category', category: category };
            if (update) {
                update_ad_list(data)
            }
            el.closest('.accord-box').addClass('active');
            $('.par_sub').removeClass('dis_none')
            $('.telic-list-item').addClass('dis_none')
            setTimeout(function () {
                $('.accord-box.side_cat').each(function (i, obj) {
                    let pl = $(this)
                    if (pl.has(el).length) {
                    } else {
                        pl.removeClass('active')
                        pl.addClass('d_none')
                    }
                    $('.subset_side').each(function (i, obj) {
                        let ef = $(this)
                        ef.removeClass('d_none')
                    });
                });
                $('.sec1').each(function (i, obj) {
                    let pl = $(this)
                    pl.removeClass('active')
                });
            }, 50)
        }

        // $('.toggle_ad').click(function () {
        //     let el = $(this)
        //     let category = el.data('id')
        //     // console.log('category'+category)
        //     data = { '_method': 'get', 'type': 'category', category: category };
        //     update_ad_list(data)

        //     // form=el.closest('#serach_form')
        //     // var form_data = new FormData(form);
        //     // console.log(form_data)
        //     // el.closest('.accord-box').toggleClass('active');
        //     el.closest('.accord-box').addClass('active');
        //     $('.par_sub').removeClass('dis_none')
        //     $('.telic-list-item').addClass('dis_none')
        //     console.log('s')

        //     setTimeout(function () {
        //         $('.accord-box.side_cat').each(function (i, obj) {
        //             let pl = $(this)
        //             if (pl.has(el).length) {
        //             } else {
        //                 pl.removeClass('active')
        //                 pl.addClass('d_none')
        //             }
        //             $('.subset_side').each(function (i, obj) {
        //                 let ef = $(this)
        //                 ef.removeClass('d_none')
        //             });
        //         });
        //         $('.sec1').each(function (i, obj) {
        //             let pl = $(this)
        //             pl.removeClass('active')
        //         });

        //     }, 50)

        //     // $('.accord-box.side_cat').each(function (i, obj) {
        //     //     let pl = $(this)
        //     //     pl.removeClass('active')
        //     //     pl.removeClass('d_none')
        //     // });
        // })





















        $('body').on('click', '#new_tag_filter', function () {
            let el = $(this)
            let val = $('#tag_filter').val()
            $('#tag_list').append(`
            <span class="applied-filter gray side">
            <span>${val}</span>
            <span class="remove-fil">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20ZM10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18ZM10 8.586L12.1206 6.46462C12.5113 6.07383 13.1448 6.07378 13.5355 6.4645C13.9262 6.85522 13.9262 7.48872 13.5354 7.87937L11.414 10L13.5354 12.1206C13.9262 12.5113 13.9262 13.1448 13.5355 13.5355C13.1448 13.9262 12.5113 13.9262 12.1206 13.5354L10 11.414L7.87937 13.5354C7.48872 13.9262 6.85522 13.9262 6.4645 13.5355C6.07378 13.1448 6.07383 12.5113 6.46463 12.1206L8.586 10L6.46462 7.87937C6.07383 7.48872 6.07378 6.85522 6.4645 6.4645C6.85522 6.07378 7.48872 6.07383 7.87937 6.46463L10 8.586Z" fill="currentColor"></path>
                </svg>
            </span>
            </span>
            `)
            el.closest('form').submit()
        });



        $('body').on('change', '.fom_action', function () {
            $(this).closest('form').submit()

        });



        $('body').on('click', '.remove_pa', function () {
            $(this).closest('.parent_li').remove()

        });
        $("#new_option").click(function () {
            let option = $("#new_op").val()
            if (option.length < 2) {
                Swal.fire('حداقل دو کاراکتر وارد کنید ');
                return false
            }


            if ($('.parent_li').length > 4) {
                Swal.fire(' حداکثر پنج گزینه میتوانید وارد کنید  ');
                return
            }
            $('#listq').append(`
            <li class="parent_li">
                <input type="text" name="options[]" value="${option}">
                <span class="remove_pa">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.99999 4.58599L10.243 0.342987C10.6335 -0.0474781 11.2665 -0.0474791 11.657 0.342986C12.0475 0.733452 12.0475 1.36652 11.657 1.75699L7.41399 5.99999L11.657 10.243C12.0475 10.6335 12.0475 11.2665 11.657 11.657C11.2665 12.0475 10.6335 12.0475 10.243 11.657L5.99999 7.41399L1.75699 11.657C1.36652 12.0475 0.733452 12.0475 0.342986 11.657C-0.0474791 11.2665 -0.0474789 10.6335 0.342987 10.243L4.58599 5.99999L0.342987 1.75699C-0.0474782 1.36652 -0.0474791 0.733452 0.342986 0.342986C0.733452 -0.0474791 1.36652 -0.0474789 1.75699 0.342987L5.99999 4.58599Z" fill="currentColor"></path>
                </svg>
                </span>
            </li>
            `)
            $("#new_op").val("")
        });
        $("#new_tag").click(function () {
            let option = $("#new_op").val()
            if (option.length < 5) {
                Swal.fire('حداقل پنج کاراکتر وارد کنید ');
                return
            }


            if ($('.parent_li').length > 4) {
                Swal.fire(' حداکثر پنج کلید میتوانید وارد کنید  ');
                return
            }
            $('#listq').append(`
            <li class="parent_li">
                <input type="text" name="tags[]" class="remove" value="${option}">

                <span class="">
                ${option}
                </span>
                <span class="remove_pa">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.99999 4.58599L10.243 0.342987C10.6335 -0.0474781 11.2665 -0.0474791 11.657 0.342986C12.0475 0.733452 12.0475 1.36652 11.657 1.75699L7.41399 5.99999L11.657 10.243C12.0475 10.6335 12.0475 11.2665 11.657 11.657C11.2665 12.0475 10.6335 12.0475 10.243 11.657L5.99999 7.41399L1.75699 11.657C1.36652 12.0475 0.733452 12.0475 0.342986 11.657C-0.0474791 11.2665 -0.0474789 10.6335 0.342987 10.243L4.58599 5.99999L0.342987 1.75699C-0.0474782 1.36652 -0.0474791 0.733452 0.342986 0.342986C0.733452 -0.0474791 1.36652 -0.0474789 1.75699 0.342987L5.99999 4.58599Z" fill="currentColor"></path>
                </svg>
                </span>
            </li>
            `)
            $("#new_op").val("")
        });
        $("#header-upload").change(function () { // bCheck is a input type button
            var fileName = $(this).val();
            if (fileName) {
                $('#cover_form').submit()
            }
            console.log(606)
        });

        $('#reward').change(function () {
            let el = $(this)
            let val = el.find(":selected").val();
            console.log(val)
            if (val != "no_reward") {
                $('#p_price').show(400)
            } else {
                $('#p_price').hide(400)

            }
        });

        $('#edit_counsel').click(function () {
            let el = $(this)
            let id = el.data('id')
            var form_data = new FormData($('#edit_counsel_form')[0]);
            form_data.append('_method', 'post')
            $.ajax('/panel/edit_counsel/' + id, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    // 'Content-Type':'application/json,charset=utf-8'
                },
                type: 'post',
                data: form_data,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    end_loading()
                    if (data.status == 'ok') {
                        noty('    اطلاعات با موفقیت ثبت شد', 'green', '');
                        setTimeout(() => {
                            window.location.href = "/panel/counsel"
                        }, 400);
                    } else {
                        for (const item in data) {
                            noty(data[item], 'red', '');
                            break;
                        }
                    }
                },
                error: function (request, status, error) {
                    console.log(request);
                    // stop_animation()
                    noty('       مشکلی ایجاد شده     ', 'red', '');
                }
            })
        })



        $('#save_counsel').click(function () {
            load_animation()
            var form_data = new FormData($('#counsel_form')[0]);
            form_data.append('_method', 'post')
            $.ajax('/panel/new_counsel1', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    // 'Content-Type':'application/json,charset=utf-8'
                },
                type: 'post',
                data: form_data,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                datatype: 'json',
                success: function (data) {
                    stop_animation()
                    console.log(data);
                    end_loading()
                    if (data.status == 'ok') {
                        noty('    اطلاعات با موفقیت ثبت شد', 'green', '');
                        if (data.type == 1) {
                            $('#pay_b').show(400)
                            $('#save__b').hide(400)
                            $('#counsel_id').val(data.counsel_id)
                            $('#amount').val(data.amount)
                            window.location.href = "/panel/new_counsel2/" + data.counsel_id

                        } else {
                            setTimeout(() => {
                                window.location.href = "/panel/new_counsel2/" + data.counsel_id
                            }, 400);
                        }

                    } else {
                        for (const item in data) {
                            noty(data[item], 'red', '');
                            break;
                        }
                    }
                },
                error: function (request, status, error) {
                    console.log(request);
                    // stop_animation()
                    noty('       مشکلی ایجاد شده     ', 'red', '');
                }
            })
        })
        $('.force_remove').click(function () {
            let el = $(this)
            let id = el.data('id')
            // $('.box_remove').show(400)
            // $('#quest-modal-no').show(400)
            $('#modal_fave_' + id).show(400)
            console.log(id)
            console.log(4004)
            $('.remove_resume').click(function () {
                // $.ajax('/panel/resume/' + id, {
                //     headers: {
                //         'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                //     },
                //     data: { "_method": "delete", id: id },
                //     type: 'post',
                //     success: function (data) {
                //         console.log(data)
                //         $('#resume_' + id).remove()
                //     },
                //     error: function (request, status, error) {
                //         console.log(request)
                //     }
                // })
            })
        })
        $('.new_resume').click(function () {
            $('#resume-modal').show(400)

        })
        $('.new_assiat').click(function () {
            $('#assiat_modal').show(400)

        })
        $('.inter_new_assistant').click(function () {
            var form_data = new FormData($('#assist_form')[0]);
            form_data.append('_method', 'post')
            $.ajax('/panel/assist', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    // 'Content-Type':'application/json,charset=utf-8'
                },
                type: 'post',
                data: form_data,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    end_loading()
                    if (data.status == 'ok') {
                        noty('    اطلاعات با موفقیت ثبت شد', 'green', '');
                        $('.close_modal').click()
                        setTimeout(() => {
                            location.reload();
                        }, 400);
                    } else {
                        for (const item in data) {
                            noty(data[item], 'red', '');
                            break;
                        }
                    }
                },
                error: function (request, status, error) {
                    console.log(request);
                    // stop_animation()
                    noty('       مشکلی ایجاد شده     ', 'red', '');
                }
            })
        })
        $('#insert_resume').click(function () {
            var form_data = new FormData($('#resume_form')[0]);
            form_data.append('_method', 'post')
            load_animation()
            $.ajax('/panel/resume', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    // 'Content-Type':'application/json,charset=utf-8'
                },
                type: 'post',
                data: form_data,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    stop_animation()
                    end_loading()
                    if (data.status == 'ok') {
                        noty('    اطلاعات با موفقیت ثبت شد', 'green', '');
                        $('.close_modal').click()
                        setTimeout(() => {
                            window.location.href = "/panel/resumes"
                        }, 400);
                    } else {
                        for (const item in data) {
                            noty(data[item], 'red', '');
                            break;
                        }
                    }
                },
                error: function (request, status, error) {
                    console.log(request);
                    // stop_animation()
                    noty('       مشکلی ایجاد شده     ', 'red', '');
                }
            })

        })





















        $('.sample_text').click(function () {
            let el = $(this)
            let id = el.data('id')
            let chat = el.text()
            $('#send_chat').val(chat)
            // send_chat(id, chat)
        })

        $('.cancel_deposit').click(function () {
            let el = $(this)
            let id = el.data('id')

            Swal.fire({
                title: 'در صورت تایید مبلغ بیعانه به کیف پول شمابرگشت  داده خواهد شد ',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'تایید ',
                denyButtonText: `دستم خورد`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    el.closest('form').submit()
                }
            })
        })
        $('.add_report').click(function () {
            $('#report_modal').show(400)
            let el = $(this)
            let id = el.data('id')
            if (($('#deposit_id').length)) {

                $('#deposit_id').val(id)
            }
        })
        $('#new_comment_baladchi').click(function () {
            let el = $(this)
            let id = el.data('id')
            console.log(id)
            var form_data = new FormData($('#comment_form_balad')[0]);
            form_data.append('_method', 'post')
            // if (!$("#commentbalad").val()) {
            //     noty('   لطفا نظر خود را بنویسید  ', 'red', '');
            //     return false;
            // }

            // if (!$("input[name='star']:checked").val()) {
            //     noty('   لطفا رضایت خود را ثبت کنید   ', 'red', '');
            //     return false;
            // }
            $.ajax('/insert_comment', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                data: form_data,
                type: 'post',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                dataType: "json",
                success: function (data) {
                    console.log(data)
                    if (data.reject == 1) {
                        noty('        نظر شما به روز شد     ', 'green', '');
                    } else {
                        noty('        نظر  شما ثبت شد  ', 'green', '');
                        setTimeout(() => {
                            location.reload();

                        }, 500);
                    }

                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })

        })
        $('.insert_report').click(function () {
            let el = $(this)

            let type = $("input[name='report']:checked").val()
            console.log(type)
            var form_data = new FormData($('#report_form')[0]);
            form_data.append('_method', 'post')

            console.log($("input[name='scam']:checked").val())
            console.log($("input[name='scam']").val())
            if (!$("input[name='scam']:checked").val() && !$("input[name='content']:checked").val() && !$("input[name='problem']:checked").val() && !$("input[name='other']:checked").val()) {
                noty('   لطفا یک گزینه را انتخاب کنید ', 'red', '');
                return false;
            }
            $.ajax('/panel/insert_report', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                data: form_data,
                type: 'post',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                dataType: "json",
                success: function (data) {
                    console.log(data)
                    $('.close_modal').click()
                    noty('        گزارش شما ثبت شد  ', 'green', '');
                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })

        })
        $('.edit_note').click(function () {
            console.log(20)
            let el = $(this)
            let info = el.closest('.par').find('.note_info').text()
            let id = el.data('id')

            $('#edit_note').show()
            $('#user_comment').val(info)
            $('#user_comment').keypress(function () {
                console.log(id)
                console.log(60)

                info = $('#user_comment').val()
                console.log(info)
                $.ajax('/panel/insert_note/' + id, {
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    },
                    data: { info: info },
                    type: 'post',
                    success: function (data) {
                        console.log(data)
                    },
                    error: function (request, status, error) {
                        console.log(request)
                    }
                })
            })

        })
        $('.insert_note').keypress(function () {
            let el = $(this)
            let id = el.data('id')
            let info = el.val()
            $.ajax('/panel/insert_note/' + id, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                data: { info: info },
                type: 'post',
                success: function (data) {
                    console.log(data)
                },
                error: function (request, status, error) {
                    console.log(request)
                }
            })
        })
        $('.add_new_cat_group').click(function () {

            $('.new_at_list').show(400)


        })
        $(document).on('click', '#active_release', function (event) {
            let el = $(this)
            if (el.is(':checked')) {
                $('#select_ime').show(400)

            } else {
                $('#select_ime').hide(400)

            }
        })
        $(document).on('click', '.remove_cat_item', function (event) {
            let el = $(this)
            let id = el.data('id')
            $(this).closest('.pare').remove()
            console.log($('.pare').length)
            if ($('.pare').length == 0) {
                $('.add_new_cat_group').show(400)
                $('#sebd_da').hide(400)
            } else {
                if ($('.pare').length > 0) {
                    $('#sebd_da').show(400)
                    $('.add_new_cat_group').show(400)
                }

            }
            $('.no_subs_check').each(function (i, obj) {
                let ele = $(this)
                if (ele.data('id') == id) {
                    ele.show(400)
                }
            });
        })
        $('.no_subs_check').unbind('click').bind('click', function (e) {
            // $('div.sliding-menu .sub-slid').click()
            // $('.no_subs_check').click(function() {
            let el = $(this)
            let type = el.data('type')
            console.log(type)

            let id = el.data('id')
            let name = el.data('name')
            // el.closest('li').hide(400)
            $('.cat_all_list').append(
                `
                <div class="choose-cat pare">
                <span class="cat-item">
                    <span class="icon">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 18V4.70002C1.99994 4.49474 2.06305 4.29442 2.18077 4.12625C2.29849 3.95809 2.4651 3.83022 2.658 3.76002L12.329 0.244017C12.4045 0.216523 12.4856 0.20765 12.5653 0.218151C12.645 0.228651 12.721 0.258216 12.7869 0.304337C12.8527 0.350459 12.9065 0.411778 12.9436 0.483095C12.9807 0.554413 13 0.633625 13 0.714017V5.66702L19.316 7.77202C19.5152 7.83837 19.6885 7.96573 19.8112 8.13607C19.934 8.3064 20.0001 8.51105 20 8.72102V18H22V20H0V18H2ZM4 18H11V2.85502L4 5.40102V18ZM18 18V9.44202L13 7.77502V18H18Z"
                                fill="currentColor"></path>
                        </svg>
                    </span>
                    <input type="text" name="catlist[]" value="${id}|${type}" hidden>
                    <span class="text">${name}</span>
                </span>

                <div class="left-sec">


                    <span class="edit-cat pointer remove_cat_item" data-id="${id}">
                        <span class="">حذف</span>
                        <span class="icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15V13"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                <path
                                    d="M16.0418 3.01976L8.16183 10.8998C7.86183 11.1998 7.56183 11.7898 7.50183 12.2198L7.07183 15.2298C6.91183 16.3198 7.68183 17.0798 8.77183 16.9298L11.7818 16.4998C12.2018 16.4398 12.7918 16.1398 13.1018 15.8398L20.9818 7.95976C22.3418 6.59976 22.9818 5.01976 20.9818 3.01976C18.9818 1.01976 17.4018 1.65976 16.0418 3.01976Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M14.9102 4.1499C15.5802 6.5399 17.4502 8.4099 19.8502 9.0899"
                                    stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>

                        </span>
                    </span>
                </div>
            </div>
                `


            );

            $('.close_pops').closest('.modal ').css('display', 'none')
            if ($('.pare').length == 2) {
                $('.add_new_cat_group').hide(400)
            }
            if ($('.pare').length > 0) {
                $('#sebd_da').show(400)
            }

        })



















        $(document).on('click', '.submit_form', function (event) {
            let el = $(this)
            let message = el.closest('form').data('message')

            Swal.fire({
                title: message,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'تایید',
                denyButtonText: `رد`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    el.closest('form').submit()
                }
            })
        })


        $('.path_img').change(function () {
            console.log('Loading')
            let el = $(this)
            const [file] = el[0].files
            if (file) {
                let im = URL.createObjectURL(file)
                el.closest('.avatar-pop').css('background-image', 'url(' + im + ')');
                // el.closest('.par').find('#poav').attr('src', im);
                // $('#poav').attr('src', im);
                // $('#poav').src = im
            }
        })












        $(document).keypress(function (e) {
            // console.log(e.target.nodeName)
            // console.log(e.target.id)
            // console.log($('#sea').val().match(/^\d+$/))
            // console.log($('#sea').val())

            // if( e.target.id=='sea') {
            //     e.preventDefault(); //
            //     // if($('#sea').val().match(/^\d+$/)) {
            //     //     console.log('wrong')
            //     //     event.preventDefault(); //
            //     // }
            // }

        });






        // $(document).on('keydown', '#sea', function (e) {
        //     let el=$(this).val()
        //     var pattern = /^[0-9.]+$/;
        //     if(!pattern.test(el)){
        //         console.log('wrong')

        //     }




        if ($('.persian_c').length) {
            $(".persian_c").persianDatepicker({
                initialValue: true,
                persianDigit: false,
                format: 'YYYY-MM-DD',
                autoClose: true,
                initialValueType: 'gregorian',
                calendar: {
                    persian: {
                        local: 'fa'
                    }
                }
            });
        }



        //     //   if(!el.match(/^\d+$/)) {
        //     //     console.log('wrong')
        //     //         e.preventDefault()
        //     //     }
        //     // $(this).val(el.replace(',','0.'))
        //     console.log(e.keyCode)
        // })

        $(document).on('click', '.close_expert', function (event) {
            $(this).closest('.par').remove();
        })
        $(document).on('click', '#add_expert', function (event) {
            let el = $('#new_expert')
            let val = el.val().trim()
            if (val.length < 3) {
                Swal.fire('حداقل سه کاراکتر وارد کنید ');
                return
            }
            $('#expert_list').append(
                `
                <span class="applied-filter gray side par">
                <span> ${val}</span>
                <input type="text" hidden value="${val}" name="experts[]" >
                <span class="remove-fil close_expert">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 20C4.477 20 0 15.523 0 10C0 4.477 4.477 0 10 0C15.523 0 20 4.477 20 10C20 15.523 15.523 20 10 20ZM10 18C12.1217 18 14.1566 17.1571 15.6569 15.6569C17.1571 14.1566 18 12.1217 18 10C18 7.87827 17.1571 5.84344 15.6569 4.34315C14.1566 2.84285 12.1217 2 10 2C7.87827 2 5.84344 2.84285 4.34315 4.34315C2.84285 5.84344 2 7.87827 2 10C2 12.1217 2.84285 14.1566 4.34315 15.6569C5.84344 17.1571 7.87827 18 10 18ZM10 8.586L12.1206 6.46462C12.5113 6.07383 13.1448 6.07378 13.5355 6.4645C13.9262 6.85522 13.9262 7.48872 13.5354 7.87937L11.414 10L13.5354 12.1206C13.9262 12.5113 13.9262 13.1448 13.5355 13.5355C13.1448 13.9262 12.5113 13.9262 12.1206 13.5354L10 11.414L7.87937 13.5354C7.48872 13.9262 6.85522 13.9262 6.4645 13.5355C6.07378 13.1448 6.07383 12.5113 6.46463 12.1206L8.586 10L6.46462 7.87937C6.07383 7.48872 6.07378 6.85522 6.4645 6.4645C6.85522 6.07378 7.48872 6.07383 7.87937 6.46463L10 8.586Z" fill="currentColor"></path>
                    </svg>
                </span>
            </span>
                `
            )
            el.val('')

        })
















        if ($('.select2').length) {
            $('.select2').select2({
                closeOnSelect: true,
                dir: "rtl",
            });
        }
        if ($('.select2_tag').length) {
            $('.select2_tag').select2({
                // multiple: true,
                tags: true,
                dir: "rtl",
            });
            $(document).on('keypress', '.select2-search__field', function () {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });


        }





        let brand_list

        $(document).on('keyup ,change', '#search_brand', function (event) {
            let el = $(this)
            // let id =el.data('id')
            //  brand_list= $('#search_parent').html();
            if ($('#search_parent').html().indexOf("main_list") >= 0) {
                console.log(9070)
                brand_list = $('#search_parent').html();
                console.log(brand_list)
            }
            console.log(brand_list)
            let search = el.val()
            search = search.trim();
            if (search.length == 0) {
                console.log(2020)
                console.log(brand_list)
                $('#search_parent').html(brand_list);
            } else {
                let id = 23
                $.ajax('/search_brand/' + id, {
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    },
                    type: 'post',
                    data: { search: search },
                    datatype: 'json',
                    success: function (data) {
                        console.log(data);
                        $('#search_parent').html(data.html);
                    },
                    error: function (request, status, error) {
                        console.log(request);
                    }
                })
            }



        })
        $(document).on('click', '#brand', function (event) {
            $('.new_brand').css('display', 'block');
            console.log(800)

        })
        $(document).on('click', '.no_subs', function (event) {
            let el = $(this)
            let type = el.data('type')
            let id = el.data('id')
            let name = el.data('name')
            // $('#brand').val("")
            // $('#brand').append($('<option>', {
            //     value: id,
            //     text: name
            // }));
            // $('#brand')
            //     .empty()
            //     .append(`
            //     <option selected="selected" value="${id}">${name}</option>`)
            //     ;
            $('#brand_id').val(id)
            $('#brand').val(name)

            $.ajax('/admin/get_brand_year_list', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                data: { id: id },
                type: 'post',
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    $('#production_year').html(data.body)
                    if ($('.filter_class').length) {
                        $('.filter_class').click()
                        $('.close_pops').click()
                        console.log("filter_class")
                    }
                },
                error: function (request, status, error) {
                    console.log(request);
                }
            })
            $('.close_pops').closest('.modal ').css('display', 'none')
        })
        $(document).on('click', '.delete_img', function (event) {
            let el = $(this)
            el.closest('.par').remove()
        })
        $(document).on('change', '#vip', function (event) {
            let el = $(this)
            if (el.is(':checked')) {
                $('#least_box').show(400)

            } else {
                $('#least_box').hide(400)
            }
        })
        $(document).on('change', '#ad-upload', function (event) {
            let el = $(this)
            var file = this.files[0];

            if ($('.img_list').length > 5) {
                Swal.fire('   شما  حداکثر 6 عکس میتواند اپلود کنید  ');
                return
            }
            // console.log(file)
            if (file.size > 2048) {
                //   alert('max upload size is 2M');
                //   return
            }
            var form_data = new FormData();
            form_data.append('file', file);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            console.log(percentComplete);
                            if (percentComplete === 100) {

                            }
                        }
                    }, false);
                    return xhr;
                },
                url: '/save_add_pictures',
                type: "POST",
                data: form_data,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                dataType: "json",
                success: function (result) {
                    console.log(result);
                    $('#img_list').append(`
                    <li class="par img_list">
                        <div class="img img_added">
                            <span class="delete_img">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.99999 4.58599L10.243 0.342987C10.6335 -0.0474781 11.2665 -0.0474791 11.657 0.342986C12.0475 0.733452 12.0475 1.36652 11.657 1.75699L7.41399 5.99999L11.657 10.243C12.0475 10.6335 12.0475 11.2665 11.657 11.657C11.2665 12.0475 10.6335 12.0475 10.243 11.657L5.99999 7.41399L1.75699 11.657C1.36652 12.0475 0.733452 12.0475 0.342986 11.657C-0.0474791 11.2665 -0.0474789 10.6335 0.342987 10.243L4.58599 5.99999L0.342987 1.75699C-0.0474782 1.36652 -0.0474791 0.733452 0.342986 0.342986C0.733452 -0.0474791 1.36652 -0.0474789 1.75699 0.342987L5.99999 4.58599Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <img src="${result.src}" alt="">
                            <input type="hidden" name="pictures[]" value="${result.img}"/>
                        </div>
                    </li>

                    `)
                },
                error: function (request, status, error) {
                    console.log(request);
                }
            });
        });

        $('.question_active').click(function () {
            let el = $(this)
            let id = el.data('id')
            $.ajax('/admin/question_active/' + id, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                type: 'post',
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    if (Number(data.show) == 0) {
                        console.log(0);
                        el.removeClass(' alert-success')
                        el.addClass(' alert-danger')
                        el.text('مخفی')
                    } else {
                        el.removeClass(' alert-danger')
                        el.addClass(' alert-success')
                        el.text('نمایش')
                    }
                },
                error: function (request, status, error) {
                    console.log(request);
                }
            })

        })


        $('.change_telic_required').click(function () {
            let el = $(this)
            let id = el.data('id')
            let question = el.data('question')
            $.ajax('/admin/change_telic_required/' + id, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                data: { question: question },
                type: 'post',
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    if (Number(data.status) == 0) {
                        console.log(0);
                        el.removeClass(' alert-solid-success')
                        el.addClass(' alert-solid-danger')
                        el.text('غیر ضروری')

                    } else {
                        el.removeClass(' alert-solid-danger')
                        el.addClass(' alert-solid-success')

                        el.text('ضروری')
                        console.log(1);

                    }
                },
                error: function (request, status, error) {
                    console.log(request);
                }
            })

        })

        $('.change_subset_required').click(function () {
            let el = $(this)
            let id = el.data('id')
            let question = el.data('question')
            $.ajax('/admin/change_subset_required/' + id, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                data: { question: question },
                type: 'post',
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    if (Number(data.status) == 0) {
                        console.log(0);
                        el.removeClass(' alert-solid-success')
                        el.addClass(' alert-solid-danger')
                        el.text('غیر ضروری')

                    } else {
                        el.removeClass(' alert-solid-danger')
                        el.addClass(' alert-solid-success')

                        el.text('ضروری')
                        console.log(1);

                    }
                },
                error: function (request, status, error) {
                    console.log(request);
                }
            })

        })

        $('.get_phone').click(function () {
            let el = $(this)
            let id = el.data('id')
            $.ajax('/get_phone/' + id, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                type: 'post',
                datatype: 'json',
                success: function (data) {
                    el.text(data.mobile)
                },
                error: function (request, status, error) {
                    console.log(request);
                }
            })

        })
        $('.new_donate').click(function () {
            $('#donate_modal').show(400)
        })
        $('.direct_pop').click(function () {
            $('#direct_modal').show(400)
        })
        $('.insert_new_donate').click(function () {
            var form_data = new FormData($('#donate_form')[0]);
            form_data.append('_method', 'post')
            console.log(form_data);

            $.ajax('/panel/insert_new_donate', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    // 'Content-Type':'application/json,charset=utf-8'
                },
                type: 'post',
                data: form_data,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    end_loading()

                    if (data.status == 'ok') {
                        noty('    اطلاعات با موفقیت ثبت شد', 'green', '');
                        window.location.href = "/"
                    } else {

                        if (data.res == 1) {
                            noty('          در حال اتصال به درگاه برای پرداخت کمک مالی  ', 'green', '');
                            setTimeout(function () {
                                $('#donate_form').submit()
                            }, 2000)
                        } else {
                            for (const item in data) {
                                noty(data[item], 'red', '');
                                break;
                            }
                        }
                    }

                },
                error: function (request, status, error) {
                    console.log(request);
                    // stop_animation()
                    noty('       مشکلی ایجاد شده     ', 'red', '');
                }
            })

        })


        $('#insert_advertise').click(function () {
            var form_data = new FormData($('#advertise_form')[0]);
            console.log(form_data);
            start_loading()

            $.ajax('/insert_new_advertise', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    // 'Content-Type':'application/json,charset=utf-8'
                },
                type: 'post',
                data: form_data,
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false,
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    end_loading()

                    if (data.status == 'ok') {
                        noty('    اطلاعات با موفقیت ثبت شد', 'green', '');
                        if (data.all.vip == 1) {
                            window.location.href = "/checkout/" + data.id + "/?type=vip"
                        } else {
                            window.location.href = "/panel/advertises"
                        }
                        // window.location.href = "/"
                        //

                    } else {
                        for (const item in data) {
                            noty(data[item], 'red', '');
                            break;
                        }
                    }

                },
                error: function (request, status, error) {
                    console.log(request);
                    stop_animation()
                    noty('       مشکلی ایجاد شده     ', 'red', '');
                }
            })

        })
        $('.close_popup').click(function () {
            window.location.href = "/"
            // Swal.fire({
            //     toast: true,
            //     confirmButtonColor: false,
            //     text: 'A custom <span style="color:#fff">html<span> message',
            //     background: '#FD6245',
            //     timer: 79000,
            //     showConfirmButton: false,
            //     position:  'top-end'

            //   })
        })
        $(document).on('click', '.close_pops', function (event) {
            let el = $(this)
            el.closest('.modal ').css('display', 'none')
        })
        $('.toggle1').click(function () {

            let el = $(this)
            el.closest('.accord-box').toggleClass('active');
            setTimeout(function () {
                $('.accord-box.circ').each(function (i, obj) {
                    let pl = $(this)
                    if (pl.has(el).length) {
                        console.log(9090)
                    } else {
                        pl.removeClass('active')

                    }
                });
                $('.sec1').each(function (i, obj) {
                    let pl = $(this)
                    pl.removeClass('active')
                });

            }, 50)
            console.log('toggle1')


        })
        $('.toggle2').click(function () {
            let el = $(this)
            // el.parent().parent('.accord-box').removeClass('active');
            el.toggleClass('active');
            // el.closest('.sec1').toggleClass('active');

            setTimeout(function () {
                $('.sec1').each(function (i, obj) {
                    let pl = $(this)
                    if (pl.is(el)) {
                        // if (pl.has(el).length) {
                        // console.log(6060)
                    } else {
                        pl.removeClass('active')

                    }
                });

            }, 20)

        })


        $('.telic_option').on('click', function () {
            let el = $(this)
            let name = el.data('name')
            let type = el.data('type')
            let id = el.data('id')
            $('.res_name').text(`دسته بندی انتخاب شده : ${name}`)
            $('#selected_telic').text(`دسته بندی انتخاب شده : ${name}`)
            $('#catbox').hide(600)
            $('#new_telic').show(400)
            $('#select_telic').show(400)
            console.log(type)
            console.log(id)
            $("#select_telic").unbind("click").click(function () {

                // $('#select_telic').unbind("click").on('click', function () {
                start_loading()
                $('.modal').hide(400)
                $.ajax('/get_advertise_form', {
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    },
                    data: { type: type, id: id },
                    type: 'post',
                    success: function (data) {
                        console.log(data)
                        end_loading()
                        $('#form_advertise').html(data.html);
                        setTimeout(() => {
                            if ($('.select2').length) {
                                $('.select2').select2({
                                    closeOnSelect: true,
                                    dir: "rtl",
                                });
                            }
                            if ($('.nice-select').length) {
                                // $('.select2').select2()
                                $('select.nice-select').each(function () {
                                    // console.log('nice-select')

                                    var a = $(this)[0];
                                    var b = $(this).data('place');
                                    // console.log(a);
                                    NiceSelect.bind(a, { searchable: true, placeholder: b });
                                })

                            }

                            if ($('.persian_c').length) {
                                // console.log('sssssssssssssssssss')
                                $(".persian_c").persianDatepicker({
                                    initialValue: true,
                                    persianDigit: false,
                                    format: 'YYYY-MM-DD',
                                    autoClose: true,
                                    initialValueType: 'gregorian',
                                    calendar: {
                                        persian: {
                                            local: 'fa'
                                        }
                                    }
                                });
                            }

                        }, 1000);

                    },
                    error: function (request, status, error) {
                        console.log(request)
                    }
                })
                $('.accord-box').each(function (i, obj) {
                    let pl = $(this)
                    pl.prop('checked', false); //
                });
            });

            $('#new_telic').on('click', function () {
                $('.accord-box').each(function (i, obj) {
                    let pl = $(this)
                    pl.prop('checked', false); //
                });
                $('#catbox').show(200)
                $('#new_telic').hide(400)
                $('#select_telic').hide(400)
            });
        });
        $('.new_add').on('click', function () {
            $('#cat_list').show(400)
        });
        $('#cat_id').on('change', function () {
            let el = $(this)
            let id = this.value
            let name = el.find(":selected").text();
            console.log(name)
            console.log(80)
            $('#catname').text(name)
            $.ajax('/admin/sub_cat_list/' + id, {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                },
                type: 'post',
                success: function (data) {
                    $('#cat_li').html(data.html)
                    $('#subs').html(data.list)
                },
                error: function (request, status, error) { }
            })
        });



        $('form').submit(function () {
            start_loading();
            setTimeout(
                function () {
                    $(this).find("button[type='submit']").hide(400)
                    $(this).find("input[type='submit']").hide(400)
                }, 20);


        });

        $(document).on('click', '.go_login', function (event) {
            $('#login_mobile').show(400)
        })

        $(document).on('click', '.mony_less', function (event) {
            let el = $(this)
            let ba = el.data('ba')
            let mo = el.data('mo')
            Swal.fire({
                text: 'برای دیدن این آگهی باید موجودی کیف پول شما  ' + mo + " تومان باشد  ",
                footer: '<a href="/panel/wallet">  بریم موجودی خودم رو ببینم </a>'
            })

        })
        $('.resend_code').on('click', function () {
            Swal.fire('پیامک مجدد ارسال شد ')
            $.ajax('/resend_code', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    // 'Content-Type':'application/json,charset=utf-8'
                },
                type: 'post',
                success: function (data) {
                    console.log(data)
                    $('.resend_code').hide(400)
                    $('.timeer').show(400)
                    $('.square1').val('')
                    count_down()
                },
                error: function (request, status, error) {
                    console.log(error);
                }
            })
        })
        $('.p4').keyup(function (e) {
            if (this.value.length == this.maxLength) {
                this.blur()
                $('.p4').eq(1).focus()

            }


        });
        $('.close_modal').on('click', function () {
            $(this).closest('.modal').hide(400)
        })


        $(document).on('click', '.show_ac', function () {
            console.log("show_m")

            $('.show_m').toggleClass("dis_none")
        })
        $(document).on('click', '.item_menu', function () {
            //  $(this) = your current element that clicked.
            // additional code
            if ($('#panel_sidemenu').length) {
                $('#dashboard-sidabr').addClass('active')
            }
        });
        $('.close_side').on('click', function () {
            console.log(121212)
            $('#sidebar').removeClass('active');
        });
        // $('body').on('click', '.close_side', function (e) {
        //     console.log(121212)
        //     $('#sidebar').removeClass('active');
        // });
        $(document).on('click', '.item_menu', function () {
            //  $(this) = your current element that clicked.
            // additional code
            console.log("clikc1")
            if ($('#panel_sidemenu').length) {
                $('#dashboard-sidabr').addClass('active')
                console.log("active")
            } else if ($('#sidebar').length) {
                $('#sidebar').addClass('active')
                console.log("sidebar")
            } else {
                console.log("oute")
                $('body').toggleClass('out');
            }
        });

        $('body').click(function (event) {
            var id = $(this).attr('id');

            $('#dashboard #dashboard-sidabr').removeClass('active');
            // $('#sidebar').removeClass('active');

            if (!$(event.target).closest('#sidebar').length) {
                // ... clicked on the 'body', but not inside of #menutop
                $('#sidebar').removeClass('active');
            }
        })
        $('#dashboard #dashboard-sidabr').click(function (event) {
            event.stopPropagation();
        })

        // $('#sidebar').click(function (event) {
        //     event.stopPropagation();
        // })


        $('#mobile_btn').on('click', function () {
            let mobile = $('#mobile').val()
            if (mobile.length != 11) {
                Swal.fire({
                    title: 'خطا',
                    text: 'لطفا  همراه خود را به درستی  وارد کنید ',
                })
                return
            }
            $.ajax('/check_user_exist', {
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    // 'Content-Type':'application/json,charset=utf-8'
                },
                type: 'post',
                data: { mobile: mobile },
                success: function (data) {
                    console.log(data)
                    $('#login_mobile').hide(200)
                    if (data.status == 0) {
                        $('.user_mobile').text(mobile)
                        $('#code_mobile').show(200)
                        $('.square1').eq(0).focus()
                        count_down()
                    }
                    if (data.status == 1) {
                        $('#pass_mobile').show(200)
                        let i = 0
                        $('#direct_login_but').on('click', function () {

                            if (i == 2) {
                                Swal.fire(' شما فقط سه بار میتونید  امتحان کنید ')
                                i = 0
                                setTimeout(function () { location.reload(); }, 2000)
                                return
                            }
                            $.ajax('/check_password', {
                                headers: {
                                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                                },
                                data: { mobile: mobile, password: $('#direct_pass').val() },
                                type: 'post',
                                success: function (data) {
                                    if (data.status == 1) {
                                        Swal.fire('     ورود با موفقیت  انجام شد ')
                                        setTimeout(function () { location.reload(); })
                                    }
                                    if (data.status == 0) {
                                        Swal.fire('          رمز وارد شده اشتباه است  ')
                                    }
                                    console.log(data)
                                    console.log(8080)
                                },
                                error: function (request, status, error) {
                                    console.log(request);
                                }
                            })

                            i++;

                        })
                        $('#direct_login').on('click', function () {
                            $('#pass_mobile').hide(200)
                            $('#code_mobile').show(200)
                            count_down()
                            $.ajax('/resend_code', {
                                headers: {
                                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                                    // 'Content-Type':'application/json,charset=utf-8'
                                },
                                type: 'post',
                                success: function (data) {
                                    console.log(data)
                                    $('.resend_code').hide(400)
                                    $('.timeer').show(400)
                                    $('.square1').val('')
                                    count_down()
                                },
                                error: function (request, status, error) {
                                    console.log(request);
                                }
                            })

                        })



                    }
                    $('html').keyup(function (e) {
                        if (e.keyCode == 8) {
                            $('.square1 ').each(function (i, obj) {
                                if ($(this).is(":focus")) {
                                    console.log(i)
                                    if (i > 0) {
                                        let v = i - 1
                                        $('.square1 ').eq(v).focus();
                                        $('.square1 ').eq(v).val('')
                                    }

                                }
                            });
                        }
                    })


                    $('#verify_code').on('click', function () {
                        var inp = ''
                        $('.square1 ').each(function (i, obj) {
                            inp += $(this).val();
                        });

                        $.ajax('/check_code', {
                            headers: {
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                                // 'Content-Type':'application/json,charset=utf-8'
                            },
                            data: { code: inp, mobile: mobile },
                            type: 'post',
                            success: function (data) {

                                console.log(data)
                                if (data.status == true) {
                                    if (data.password) {
                                        Swal.fire('     ورود با موفقیت  انجام شد ')
                                        setTimeout(function () { location.reload(); }, 1000)
                                    } else {
                                        $('#code_mobile').hide(400)
                                        $('#repass_mobile').show(400)
                                        $('#check_pass').on('click', function () {
                                            if ($('#upass').val().replace(/\s+/, "").length == 0) {
                                                Swal.fire('لطفا ورودی ها را به درستی وارد کنید  ')
                                                return
                                            }
                                            if ($('#upass').val() == $('#reupass').val()) {
                                                $.ajax('/update_password', {
                                                    headers: {
                                                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                                                        // 'Content-Type':'application/json,charset=utf-8'
                                                    },
                                                    type: 'post',
                                                    data: { pass: $('#upass').val() },
                                                    success: function (data) {
                                                        Swal.fire('رمز با موفقیت ذخیره شد')
                                                        location.reload();
                                                    },
                                                    error: function (request, status, error) {
                                                        console.log(request);
                                                    }
                                                })
                                            } else {
                                                Swal.fire('              رمز وارد شده با تکرار آن باید یکی باشد   ')
                                            }
                                        })

                                    }
                                }
                                if (data.status == false) {
                                    Swal.fire({
                                        title: 'کد وارد شده صحیح نمی باشد  ',
                                        showConfirmButton: true,
                                        confirmButtonText: 'باشه',
                                    }).then((result) => {
                                        /* Read more about isConfirmed, isDenied below */
                                        if (result.isConfirmed) {
                                            $('.square1').val('')
                                            setTimeout(function () {
                                                $('.square1').eq(0).focus()
                                            }, 500)
                                        }
                                    })


                                }
                            },
                            error: function (request, status, error) {
                                console.log(request);
                            }
                        })
                    })

                },
                error: function (request, status, error) {
                    console.log(request);
                }
            })


            $('#forget_btn').on('click', function () {
                $('#pass_mobile').hide(200)
                $('#repass_mobile').show(200)
            })

        })
        $('.reload_captcha').on('click', function () {
            let el = $(this)
            load_recaptcha()
        })

        $('.check_pr').on('change', function () {
            // let el = $(this)
            // let val = el.val()

            let total = get_total()
            amount = total
            $('.res_pay').text(amount.toLocaleString())
            console.log(total)
            if (total > 0) {
                $('.send_pay_p').show(400)
            } else {
                $('.send_pay_p').hide(400)

            }

        })
        function get_total() {
            let total = 0

            $('.check_pr').each((index, element) => {
                let ele = $('.check_pr').eq(index)
                let check = ele.is(":checked")
                if (check) {
                    console.log(ele.val())
                    total += Number(ele.val())
                }


            });
            return total;
        }

        $('.pay_from_cash2').change(function () {
            let el = $(this)
            let total = get_total()
            let balance = el.data('balance')
            console.log(total)
            console.log(balance)
            if (el.is(':checked')) {
                if (balance > total) {
                    $('.res_pay').text(0)
                } else {
                    $('.res_pay').text((total - balance).toLocaleString())
                }
            } else {
                $('.res_pay').text(total.toLocaleString())
                // $('.res_pay').text($.number( amount))
            }
        })


    }
}
