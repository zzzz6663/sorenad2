import './bootstrap';


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

window.onload = function () {

    stop_animation()
    $("form").submit(function (e) {
        load_animation()
    });

    $("a").click(function (e) {
        if (!$(this).hasClass("no_link")) {
            load_animation()

        }
    });

    if ($('.tooltipster').length) {
        $('.tooltipster').tooltipster();
    }

    $('#send_pay').on("click", function (e) {
        $(this).closest("form").submit()

    })
    function update_app_price() {
        // let type = $('input[name="count_type"]:checked').val()
        // let val_click = $('#click_count').data("price");
        // let val_view = $('#view_count').data("price");
        // let click_count = $('#click_count').val()
        // let view_count = $('#view_count').val()
        // console.log(val)
        // console.log(type)
        // console.log(click_count)
        // console.log(view_count)
        // let total_click = click_count
        // val_click *= total_click

        // let total_view = view_count
        // val_view *= total_view

        // let tax = Math.floor(val + ((4.5 * val) / 100))
        // console.log((4.5 * val) / 100)
        // console.log(tax)
        // let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        // tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        // // val = val.num2persian()
        // if (type == "view") {
        //     $('.totoal_price_view').text(num + " تومان")
        // } else {
        //     $('.totoal_price_click').text(num + " تومان")
        // }
        // $('.totoal_price').text(num + " تومان")
        // $('.after_tax_price').text(tax + " تومان")
    }


    $('#click_count').on("change keyup", function (e) {
        let el = $(this);
        let price = Number(el.data("price"));
        let val = Number(el.val());
        val*=price
        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        $('.totoal_price_click').text(num)
        let tax = Math.floor(val + ((4.5 * val) / 100))
         tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
         $('.totoal_price').text(num + " تومان")
        $('.after_tax_price').text(tax + " تومان")
    })


    $('#view_count').on("change keyup", function (e) {
        let el = $(this);
        let price = Number(el.data("price"));
        let val = Number(el.val());
        val*=price
        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        $('.totoal_price_view').text(num)
        let tax = Math.floor(val + ((4.5 * val) / 100))
         tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
         $('.totoal_price').text(num + " تومان")
        $('.after_tax_price').text(tax + " تومان")
    })


    // $('.dropdown-toggle').on("click", function (e) {
    //     let el=$(this)
    //     el.closest("li.dropdown").find(".dropdown-menu").toggleClass("show")
    //  })
    // $('body').on("click", function (e) {
    // console.log("dddddddddd")
    //     $(".dropdown.show").toggle();
    //     $(".dropdown.open").toggle();

    //  })
    $('input[name="count_type"]').on("click", function (e) {
       $('.cal_p').val("")
       $('.totoal_price_view').text("")
       $('.totoal_price_click').text("")
       $('.totoal_price').text(0 + " تومان")
       $('.after_tax_price').text(0 + " تومان")
    })
    $('.per_price').on("click", function (e) {
        let el = $(this);
        let val = el.data("price");
        console.log(val)
        $('#amount').val(val)


        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')

        console.log(num)
        val = val.num2persian()
        $('.persian_number').text(val + " تومان")
        $('#amount_total').text(num + " تومان")
        $('.amount_total').text(num + " تومان")
    })
    $('#order_count').on("keyup change", function (e) {
        let el = $(this);
        let val = Number(el.val());
        let price = Number($('#price').val());
        val *= price
        let tax = Math.floor(val + ((4.5 * val) / 100))
        console.log((4.5 * val) / 100)
        console.log(tax)
        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        // val = val.num2persian()
        $('.totoal_price').text(num + " تومان")
        $('.after_tax_price').text(tax + " تومان")
    })
    $('.number_format').on("keyup change", function (e) {
        let el = $(this);
        let val = el.val();
        console.log(60)
        if (val > 0) {
            let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')

            console.log(num)
            val = val.num2persian()
            $('.persian_number').text(val + " تومان")
            $('#amount_total').text(num + " تومان")
            $('.amount_total').text(num + " تومان")
            // if (el.closest('.col-12').find('.green_label').length) {
            //     console.log(80)
            //     console.log(num)
            //     el.closest('.col-12').find('.green_label').html(val + " تومان" + num)
            //     el.closest('.col-12').find('.yellow_label').html(num + " تومان" + num)
            // } else {
            //     console.log(70)
            //     console.log(num)
            //     el.closest('.col-12').append(`
            //     <p class="yellow_label badge badge-success">
            //     ${num}
            //     </p>
            //     <p class="green_label badge badge-success">  ${val} -     ${num}
            //     تومان</p>


            //     `)
            // }

        } else {
            $('.persian_number').text(0 + " تومان")
            $('#amount_total').text(0 + " تومان")
        }
    })



    console.log(8080)
    if ($('.select2').length) {
        console.log(8080)
        $('.select2').select2();
    }
    if ($('#box_chat').length) {

        $('#box_chat').scrollTop($('#box_chat')[0].scrollHeight);
    }
    // if ($('.persian_date').length) {
    //     $(".persian_date").pDatepicker(
    //         {
    //             "altField": '#timestamp',
    //             "initialValue": false,
    //             "observer": true,
    //             "autoClose": true,
    //             "format": 'YYYY/MM/DD'
    //         }
    //     );
    // }
    // if ($('.tooltiper').length) {
    //     $('.tooltiper').tooltipster();
    // }
    $(document).on('change', '#file_select', function (event) {
        let el=$(this)
        var filename = el.val().split('\\').pop();
        $('.file_name').text(filename)
    });
    $(document).on('click', '.form_close', function (event) {
        let el=$(this)
        console.log(12)
        el.closest("form").submit()
    });
    let count = 0
    $(document).on('click', '#check_code', function (event) {

        let code = $('#code').val()
        if (count == 3) {
            Swal.fire({
                text: "تعداد سعی شما  بیشتر از حد مجاز هست!",
                showConfirmButton: false,
                timer: 1500,
                icon: "error",
            });
            setTimeout(() => {
                location.reload();
            }, 2000);
            return
        }

        if (!code) {
            Swal.fire({
                text: "لطفا کد   را به درستی وارد کنید!",
                showConfirmButton: false,
                timer: 1500,
                icon: "error",
            });
            return
        }

        load_animation()
        $.ajax('/check_code', {
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            type: 'post',
            data: { code: code },
            datatype: 'json',
            success: function (data) {
                console.log(data)
                stop_animation()
                if (data.status == "ok") {
                    window.location.href = "/redirect"

                } else {
                    count++
                    Swal.fire({
                        text: "لطفا کد   را به درستی وارد کنید!",
                        showConfirmButton: false,
                        timer: 1500,
                        icon: "error",
                    });
                }



            },
            error: function (request, status, error) {
                console.log(request);
                stop_animation()
            }
        })
    });


    $(document).on('click', '#wrong', function (event) {

        $('#first').slideDown(400)
        $('#second').slideUp(400)
        $('#mobile').val("")

    });
    $(document).on('click', '#send_code', function (event) {
        let mobile = $('#mobile').val()

        var regex = new RegExp("^(\\+98|0)?9\\d{9}$");
        var result = regex.test(mobile);
        if (!result) {
            Swal.fire({
                text: "لطفا همراه خود را به درستی وارد کنید!",
                showConfirmButton: false,
                timer: 1500,
                icon: "error",
            });
            return
        }
        $('.mobile').text(mobile)
        load_animation()
        $.ajax('/mobile_login', {
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            type: 'post',
            data: { mobile: mobile },
            datatype: 'json',
            success: function (data) {
                console.log(data);
                stop_animation()
                $('#first').slideUp(400)
                $('#second').slideDown(400)


            },
            error: function (request, status, error) {
                console.log(request);
                stop_animation()
            }
        })

    });








}


