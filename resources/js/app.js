import './bootstrap';
let admin_tax = 4.5

function stop_animation() {
    if ($('.modal-mask').length) {
        $('.modal-mask').remove()
    }
}
console.log(5)
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
    //    let popunder = window.open("https://www.google.com/", "popupWindow", "width=600,height=600,scrollbars=yes,");

    stop_animation()
    $("form").submit(function (e) {
        load_animation()
    });

    $("a").click(function (e) {
        console.log(222)
        let el = $(this)
        let h = el.attr('href')

        console.log(el.hasClass("no_link"))

        if (h.search('#') == -1 && !el.hasClass("no_link")) {
            load_animation()

        }
    });
    const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        console.log(window.location.origin)
        xhr.open('POST', window.location.origin + '/advertiser/add_tiny_image');
        xhr.setRequestHeader("X-CSRF-TOKEN", document.head.querySelector('meta[name="csrf-token"]').content);

        xhr.upload.onprogress = (e) => {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = () => {
            if (blobInfo.blob().size > 1024 * 1024) {
                return reject({ message: 'File is too big!', remove: true });
            }

            if (xhr.status === 403) {
                reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                return;
            }

            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
            }

            const json = JSON.parse(xhr.responseText);
            console.log(json.location)
            if (!json || typeof json.location != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
            }

            resolve(json.location);
        };

        xhr.onerror = () => {
            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    });
    if ($('#tiny').length) {
        console.log(60605)
        tinymce.init({
            selector: '#tiny',
            language: 'fa',
            plugins: ["image", "emoticons"],
            height: 200,
            menubar: false,
            remove_script_host: false,
            convert_urls: false,
            toolbar: 'emoticons forecolor backcolor | image |undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent  | color',

            // without images_upload_url set, Upload tab won't show up
            // images_upload_url: 'upload.php',

            // override default upload handler to simulate successful upload
            images_upload_handler: image_upload_handler_callback,
            setup: function (editor) {
                editor.ui.registry.addIcon('image', 'آپلود ');  // ایجاد آیکون سفارشی برای دکمه image
                editor.ui.registry.addButton('image', {
                    icon: 'image',  // استفاده از آیکون ایجاد شده
                    onAction: function (_) {
                        editor.execCommand('mceInsertContent', false, '<img src="http://www.example.com/image.jpg">');
                    },
                    onPostRender: function () {
                        const button = this;
                        button.iconElem.classList.add('my-custom-class');
                    }

                });
                editor.on('change', function () {
                    // Handle the change event here
                    $('#s_info').html(tinymce.get("tiny").getContent())
                    console.log();
                });

            }
        });
        setTimeout(() => {
            $('.tox-toolbar__group').children().last().find("button").css("width", "150px")

        }, 1500);
    }

    if ($('#tiny_text').length) {
        console.log(60605)
        tinymce.init({
            selector: '#tiny_text',
            language: 'fa',
            plugins: ["image", "emoticons"],
            height: 200,
            menubar: false,
            remove_script_host: false,
            convert_urls: false,
            toolbar: 'emoticons forecolor backcolor |undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | outdent indent  | color',

            // without images_upload_url set, Upload tab won't show up
            // images_upload_url: 'upload.php',

            // override default upload handler to simulate successful upload
            images_upload_handler: image_upload_handler_callback,
            setup: function (editor) {
                editor.ui.registry.addIcon('image', 'آپلود تصویر');  // ایجاد آیکون سفارشی برای دکمه image
                editor.ui.registry.addButton('image', {
                    icon: 'image',  // استفاده از آیکون ایجاد شده
                    onAction: function (_) {
                        editor.execCommand('mceInsertContent', false, '<img src="http://www.example.com/image.jpg">');
                    },
                    onPostRender: function () {
                        const button = this;
                        button.iconElem.classList.add('my-custom-class');
                    }

                });
                editor.on('change', function () {
                    // Handle the change event here
                    $('#s_info').html(tinymce.get("tiny_text").getContent())
                    console.log();
                });

            }
        });
        setTimeout(() => {
            $('.tox-toolbar__group').children().last().find("button").css("width", "150px")

        }, 1500);
    }



    function update_btn($step, el = null) {
        console.log($step)
        if (null) {
            $('.next_p').slideDown(200)
            $('.prev_p').slideUp(200)
            $('.fin_pay').slideUp(200)
        }else{
            switch ($step) {
                case 0:
                    console.log(11)
                    el.closest('form').find('.prev_p').slideUp(200)
                    el.closest('form').find('.next_p').slideDown(200)
                    el.closest('form').find('.next_p').text("بعدی")
                    // $('.fin_pay').slideUp(200)
                    el.closest('form').find('.fin_pay').slideUp(200)

                    break;
                case 1:
                    console.log(21)
                    el.closest('form').find('.prev_p').slideDown(200)
                    el.closest('form').find('.next_p').slideDown(200)
                    el.closest('form').find('.fin_pay').slideUp(200)
                    el.closest('form').find('.next_p').text("بعدی")
                    break;
                case 2:
                    console.log(31)
                    el.closest('form').find('.prev_p').slideDown(200)
                    $('.next_p').text("ذخیره")
                    el.closest('form').find('.fin_pay').slideDown(200)
                    break;

            }
        }

        // setTimeout(() => {
        //     el.closest('form').find('.next_p').text("ذخیره")
        // }, 200);

    }



    // $(".tal").unbind("click").click(function () {
    //     let el = $(this)
    //     $('.tab-pane').slideUp(100)
    //     $('.tal a').removeClass("active")

    //     setTimeout(() => {
    //         $('.tab-pane').eq(el.index()).slideDown(400)
    //         el.find("a").addClass("active")
    //     }, 200);
    // $('.fin_pay').on("click", function (e) {
        $(".fin_pay").unbind("click").click(function () {
        let el = $(this)
        console.log(12)
        el.closest("form").find('.should_pay').val(1)
        send_data(el)
    });
        let index = 0

        $(".next_p").unbind("click").click(function () {
            let el = $(this)
            send_data(el)



        })

        function send_data(el) {
            let url = el.closest('form').attr("action")
            console.log(index)
            var form_data = new FormData(el.closest('form')[0]);
            form_data.append("step", index + 1)
            load_animation()
            $.ajax(url, {
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
                    if (data.status == 'ok') {
                        index++
                        update_btn(index, el)
                        el.closest('form').find('.step').slideUp(100)
                        setTimeout(() => {
                            el.closest('form').find('.step').eq(index).slideDown(400)
                            el.closest('form').find('.taby').eq(index).addClass("current")
                        }, 200);
                        if (index == 3) {
                            el.closest('form').submit()
                        }
                    } else {
                        for (const item in data) {
                            console.log(item);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                position: "center",
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: data[item]
                            });
                            let els = $('[name="' + item + '"]')
                            $([document.documentElement, document.body]).animate({
                                scrollTop: els.offset().top - 200
                            }, 500);
                            els.addClass("redd")

                            setTimeout(() => {
                                els.removeClass("redd")
                            }, 2000);
                            break;
                        }
                    }

                },
                error: function (request, status, error) {
                    stop_animation()
                    console.log(request)
                }
            })
            $(".prev_p").unbind("click").click(function () {
                let el = $(this)
                console.log(index)
                el.closest('form').find('.step').slideUp(100)
                setTimeout(() => {
                    index--
                    update_btn(index, el)
                    el.closest('form').find('.step').eq(index).slideDown(400)
                    // $('.taby').eq(index + 1).removeClass("current")
                    el.closest('form').find('.taby').eq(index + 1).removeClass("current")
                }, 200);
            })
        }

    $('#send_pay').on("click", function (e) {
        $(this).closest("form").submit()

    })


    $('#attach').on('change', function (event) {
        let el = $(this)
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'mp4'];
        let ex = el.val().split('.').pop().toLowerCase()
        if ($.inArray(ex, fileExtension) == -1) {
            let me = "فرمت های قابل قبول : " + fileExtension.join(', ')
            const Toast = Swal.mixin({
                toast: true,
                position: "center",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: me
            });
            return
        }
        if (ex == "mp4") {
            var video = document.createElement('video');
            video.controls = true;
            video.style.maxWidth = '100%';
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function (event) {
                video.src = event.target.result;
            };
            reader.readAsDataURL(file);
            $('#per_ch_video').slideDown(400)
            $('#per_ch_video').html(video)
        } else {
            $('#per_ch_video').slideDown(400)
            var img = document.createElement('img');
            img.style.maxWidth = '100%';
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function (event) {
                console.log(event.target.result)
                img.src = event.target.result;
            };
            reader.readAsDataURL(file);
            $('#per_ch_video').html(img)
        }





        // var file = event.target.files[0];
        // console.log(file)
        // var reader = new FileReader();
        // el.controls = true;

        // reader.onload = function(event) {
        //     console.log(1212)
        //     el.src = event.target.result;
        // };

        // reader.readAsDataURL(file);

    });




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

        // let tax = Math.floor(val + ((admin_tax * val) / 100))
        // console.log((admin_tax * val) / 100)
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

    $('#hamsan').on("change", function (e) {
        let el = $(this);
        let val = (el.val());
        console.log($('#hamsan').is(":checked"))
        if ($('#hamsan').is(":checked")) {
            $('#float_app').prop('checked', false);
            $('#float_app').attr('checked', false)
                ;
        }
    })

    $('.submit_form').on("change", function (e) {
        let el = $(this);
        el.closest("form").submit()
    })
    $('#float_app').on("change", function (e) {
        let el = $(this);
        let val = (el.val());
        console.log($('#float_app').is(":checked"))
        if ($('#float_app').is(":checked")) {
            $('#hamsan').prop('checked', false);
            $('#hamsan').attr('checked', false)
                ;
        }
    })
    function removeExtraSpaces(inputString) {
        // استفاده از عبارت منظم برای جایگزینی بیش از دو فضای خالی با یک فضای خالی
        return inputString.replace(/\s{2,}/g, ' ');
    }
    $('.copy_c').on("click", function (e) {
        let el = $(this);
        let txt = el.closest('.content').find(".content_ms").text()
        console.log(txt)

         txt = removeExtraSpaces(txt);
         console.log(txt)
        navigator.clipboard.writeText(txt).then(
            function () {
                Swal.fire({
                    toast: true,
                    position: "top-center",
                    text: "متن  کپی شد !",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
            },
            function () {
            }
        )
    })
    $('.copy_h').on("click", function (e) {
        let el = $(this);
        let id = (el.data("id"));

        let url = ` <div id="${id}"></div>`
        navigator.clipboard.writeText(url).then(
            function () {
                Swal.fire({
                    toast: true,
                    position: "top-center",
                    text: "کد  کپی شد !",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
            },
            function () {
            }
        )
    })
    $('.copy').on("click", function (e) {
        let el = $(this);
        let url = (el.data("url"));
        url = `<script  src="${url}"></script>`
        navigator.clipboard.writeText(url).then(
            function () {
                Swal.fire({
                    toast: true,
                    position: "top-center",
                    text: "متن  کپی شد !",
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
            },
            function () {
            }
        )
    })
    $('#price_suggestion').on("change keyup", function (e) {
        let el = $(this);
        let val = Number($('#click_count').val()) * Number(el.val())
        console.log(val)
        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        $('.totoal_price').text(num)

        let tax = Math.floor(val + ((admin_tax * val) / 100))
        if (tax > 2000000) {
            console.log(tax)
            $('#pay_chanal').slideDown(400)
        } else {
            $('#pay_chanal').slideUp(400)
        }
        tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        $('.totoal_price').text(num + " تومان")
        $('.after_tax_price').text(tax + " تومان")




    })
    $('.order_count').on("change keyup", function (e) {
        let el = $(this);
        el.closest("form").find(".order_count").val(el.val())
        let price = Number(el.data("price"));
        if ($('#pay_chanal').length) {
            price = $('#price_suggestion').val();
        }
        let val = Number(el.val());
        val *= price
        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        $('.totoal_price_click').text(num)
        let tax = Math.floor(val + ((admin_tax * val) / 100))
        if (tax > 2000000) {
            console.log(tax)
            $('#pay_chanal').slideDown(400)
        } else {
            $('#pay_chanal').slideUp(400)
        }
        tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        $('.totoal_price').text(num + " تومان")
        $('.after_tax_price').text(tax + " تومان")
    })
    if ($('#pay_chanal').length) {
        let p = $('#pay_chanal').data("p")
        if (p > 2000000) {
            console.log(p)
            $('#pay_chanal').slideDown(400)
        } else {
            $('#pay_chanal').slideUp(400)
        }
    }
    $('.remove_faq').on("click", function (e) {
        let el = $(this);
        let id = (el.data("id"));
        $.ajax('/admin/faq/' + id, {
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            type: 'post',
            data: { _method: "delete" },
            datatype: 'json',
            success: function (data) {
                console.log(data)
                el.closest(".par").slideUp(400)

            },
            error: function (request, status, error) {
                console.log(request);
                stop_animation()
            }
        })


    })


    $('#view_count').on("change keyup", function (e) {
        let el = $(this);
        let price = Number(el.data("price"));
        let val = Number(el.val());
        val *= price
        let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        $('.totoal_price_view').text(num)
        let tax = Math.floor(val + ((admin_tax * val) / 100))
        tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
        $('.totoal_price').text(num + " تومان")
        $('.after_tax_price').text(tax + " تومان")
    })
    if ($('a[href*="finish"]').length) {
        $('a[href*="finish"]').slideUp(400)
    }


    // $('.dropdown-toggle').on("click", function (e) {
    //     let el=$(this)
    //     el.closest("li.dropdown").find(".dropdown-menu").toggleClass("show")
    //  })
    // $('body').on("click", function (e) {
    // console.log("dddddddddd")
    //     $(".dropdown.show").toggle();
    //     $(".dropdown.open").toggle();

    //  })
    $('.countable').keypress(function (event) {
        let el = $(this)
        let max = el.data("m")
        let length = el.val().length
        if (Number(max) == Number(length)) {
            console.log(80)
            event.preventDefault()
        }
        el.closest(".form-control-wrap").find(".count").html(`
        ${max}/
        <span class="count_d">${length}</span>
        `)

    })
    $('#call_to_action_video').on("keyup change", function (e) {
        console.log(12)
        let val=$(this).val()
        $('#s_call_to_action').text(val)

    })

    $('#landing_title1_video').on("keyup change", function (e) {
        console.log(12)
        let val=$(this).val()
        $('#video_sorenad_btn_par').html(`

        <a target="blank" class="sorenad_btn" href="">
        ${val}
    </a>
        `)

    })



    $('.titl_f').on("keyup change", function (e) {
        console.log(12222)
        $('#sorenad_title').text($(this).val())
        $('#title_p').text($(this).val())


    })
    $('[name="info"]') .on("keyup change", function (e) {
        $('#sorenad_title').text($(this).val())
        $('#sorenad_info').text($(this).val())

    })

    $('#landing_link2').on("keyup change", function (e) {
        let val1 = $('#landing_link2').val()
        if (val1) {
            $('#landing_link2_p').html(`
            ${val1}
            `)
        }
    })
    $('#landing_link1').on("keyup change", function (e) {
        let val1 = $('#landing_link1').val()
        if (val1) {
            $('#landing_link1_p').html(`
            ${val1}
            `)
        }
    })
    $('#landing_title2').on("keyup change mouseup", function (e) {
        let val1 = $('#landing_title2').val()
        $('#landing_title2_p').html(`
        ${val1}
        `)
    })


    // $('#bt_color').on("keyup change", function (e) {
    //     console.log($(this).val())
    //     $('#landing_title1_p').css("background",$(this).val())

    //  })
    //

    $('#bt_color').on("keyup change click", function (e) {

        console.log(666)
        console.log($('#bt_color').val())
        $('#landing_title1_p').css("background", $('#bt_color').val())
    })



    $('[name="landing_title1"]').on("keyup change", function (e) {
        let le=$(this)
        $('#video_sorenad_btn_par').empty()
        $('#fix_sorenad_btn_par').empty()
        let val1 =le.val()
        console.log(val1)
        console.log(val1)
        if (val1) {
            $('#fix_sorenad_btn_par').append(`
            <a target="blank" class="sorenad_btn" href="">
            ${val1}
              </a>
            `)

            $('#video_sorenad_btn_par').append(`
            <a target="blank" class="sorenad_btn" href="">
            ${val1}
              </a>
            `)

            $('#landing_title1_p').html(`
            ${val1}
            `)

        }

    })

    $('[name="call_to_action"]').on("keyup change", function (e) {
        console.log(32323)
        let el=$(this)
        $('#s_call_to_action').text(el.val())
        $('#s_call_to_action_fix').text(el.val())
    })


    $('#bg_color').on("keyup change", function (e) {
        console.log($('#bg_color').val())
        $('#fixpost_container').css("background", $('#bg_color').val())
    })




    $('.landing_title').on("keyup change", function (e) {
        let val1 = $(this).val()
        console.log(val1)
        $('#sorenad_btn_par').empty()
        if (val1) {
            $('#sorenad_btn_par').append(`
            <a target="blank" class="sorenad_btn" href="">
            ${val1}
              </a>
            `)
        }
        let val2 = $('#landing_title2').val()
        if (val2) {
            $('#sorenad_btn_par').append(`
            <a target="blank" class="sorenad_btn" href="">
            ${val2}
              </a>
            `)



        }

        let val3 = $('#landing_title3').val()
        if (val3) {
            $('#sorenad_btn_par').append(`
            <a target="blank" class="sorenad_btn" href="">
            ${val3}
              </a>
            `)
        }

        $('#landing_title1_p').html(`
        ${val1}
        `)






    })

    $('input[name="banner1"]').on("change", function (e) {

        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('banner1_p').src = e.target.result;
                // document.getElementById('sorenad_app_logo').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    })
    $('#icon').on("change", function (e) {
        var file = this.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('sorenad_app_logo').src = e.target.result;
                // document.getElementById('sorenad_app_logo').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    })
    $('input[name="count_type"]').on("click", function (e) {
        let el = $(this)
        console.log(el.val())
        if (el.val() == "click") {
            $('.click_inp').removeAttr('disabled');
            $('.view_inp').attr('disabled', 'disabled');;
        } else {
            $('.view_inp').removeAttr('disabled');
            $('.click_inp').attr('disabled', 'disabled');;
        }
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
    // $('#order_count').on("keyup change", function (e) {
    //     let el = $(this);
    //     let val = Number(el.val());
    //     let price = Number($('#price').val());
    //     val *= price
    //     let tax = Math.floor(val + ((admin_tax * val) / 100))
    //     console.log((admin_tax * val) / 100)
    //     console.log(tax)
    //     let num = String(val).replace(/(.)(?=(\d{3})+$)/g, '$1,')
    //     tax = String(tax).replace(/(.)(?=(\d{3})+$)/g, '$1,')
    //     // val = val.num2persian()
    //     $('.totoal_price').text(num + " تومان")
    //     $('.after_tax_price').text(tax + " تومان")
    // })

    $('.add_active').change(function () {
        // $('.add_active').on("change", function (e) {
        let el = $(this);
        let id = el.data("id");
        load_animation()
        $.ajax('/advertiser/add_active/' + id, {
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
            },
            type: 'post',
            datatype: 'json',
            success: function (data) {
                console.log(data)
                stop_animation()
                $('label[for="add_active' + id + '"]').text(data.active ? "فعال " : "غیر فعال");

            },
            error: function (request, status, error) {
                console.log(request);
                stop_animation()
            }
        })
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
    $(document).on('click', '.confirm_reject', function (event) {
        let el = $(this)
        Swal.fire({
            title: "در صورت تایید تبلیغ برای همیشه غیر فعال شده و باقیمانده شارژ به حساب شما باز میگردد?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "تایید",
            denyButtonText: `ی خیال`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                el.closest('form').submit()
            } else if (result.isDenied) {
            }
        });

    });
    $(document).on('change', 'input[name="priod"]', function (event) {
        let el = $(this)
        console.log(el.val())
        $(".date-picker").val('')
    });
    $(document).on('click', '.date-picker', function (event) {
        console.log(12)
        $('input[name="priod"]').prop("checked", false);
        $('input[name="priod"]').removeAttr("checked");
    });
    $(document).on('change', '#file_select', function (event) {
        let el = $(this)
        var filename = el.val().split('\\').pop();
        $('.file_name').text(filename)
    });
    $(document).on('change', '#file_select', function (event) {
        let el = $(this)
        var filename = el.val().split('\\').pop();
        $('.file_name').text(filename)
    });
    $(document).on('click', '.form_close', function (event) {
        let el = $(this)
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





    if ($(".edit_area").length) {
        console.log("sss")

        let element = $(this)
        let translate = $(this).data('translate')
        let direction = $(this).data('direction')


        let mc = tinymce.init({
            height: "300",
            selector: '.edit_area',
            toolbar_mode: 'Wrap',
            menubar: true,
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            width: '100%',
            statusbar: true,
            directionality: 'rtl',
            content_css: '/css/tiny.css',
            // forced_root_block : 'p',
            // forced_root_block_attrs: {
            //     'class': 'myclass',
            //     'data-something': 'my data'
            //   },
            // readonly  :1,

            contextmenu: "paste",
            forced_root_block: 'div',
            plugins: [
                'textcolor', 'advlist', 'autolink', 'lineheight',
                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
                'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount', 'directionality'
            ],
            toolbar: "ltr rtl lineheight select  backcolor aligncenter  alignleft alignnone alignright alignjustify bold italic copy cut fontsizeselect paste formatselect undo redo bullist numlist  outdent indent removeformat ",
            // language : "fa_IR",
            lineheight_formats: "8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 36pt",

            theme: "silver",

            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/admin/upload_image_tiny_mc',
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                console.log(12144);
                console.log(meta);
                console.log(value);
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function () {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            },
            setup: function (editor) {
                editor.on('keyup change click', function (e) {

                });
            }

        });



    }






}


