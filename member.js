$(document).ready(()=>{
  /* Member Page */
  $('.member-form form').each((i, e) => {
    //console.log('fired')
    $(e).submit((event) => {
      event.preventDefault();
      switch(true) {
        case $(e).hasClass('form-login'):
          jQuery.ajax({
            url: member_ajax_obj.ajax_url,
            type: 'POST',
            data: {
              action: 'get_member_data',
              member_login_nonce: jQuery('#member_login_nonce').val(),
              email: $('#member_username').val()
            },
            success: function(response) {
              if (response.success) {
                //console.log(response.data.status)
                if(response.data.status === 'active') {
                  $('#member_username_hidden').val($('#member_username').val());
                  $('.member-step-password .login-display-image').attr('src', response.data.image);
                  $('.member-step-password .login-display-email').text(response.data.email);
                  $('.member-step-password .login-display-type').text(response.data.type);
                  
                  $('.member-step').each((i, step) => {
                    if ($(step).hasClass('member-step-password')) {
                      $(step).removeClass('d-none');
                    } else {
                      $(step).addClass('d-none');
                    }
                  })
                } else if(response.data.status === 'suspended' || response.data.status === 'pending') {

                  jQuery.ajax({
                    url: member_ajax_obj.ajax_url,
                    type: 'POST',
                    data: {
                      action: 'handle_member_suspended_otp',
                      member_login_nonce: jQuery('#member_login_nonce').val(),
                      email: $('#member_username').val()
                    },
                    success: function(response) {
                      if (response.success) {

                        $('#member_username_hidden').val($('#member_username').val());
                        
                        $('.member-step-verify .login-display-email').text($('#member_username').val());

                        $('.member-step').each((i, step) => {
                          if ($(step).hasClass('member-step-verify')) {
                            $(step).removeClass('d-none');
                          } else {
                            $(step).addClass('d-none');
                          }
                        })
                        
                      } else {
                        window.location.href = '/member/?status=failed';
                      }
                    },
                    error: function(error) {
                      console.log(error)
                      window.location.href = '/member/?status=failed';
                    }
                  })
                } else {
                  window.location.href = '/member/?status=' + response.data.status;
                  return;
                }
              }

            },
            error: function() {
              window.location.href = '/member/?status=failed_login';

              return
            }
          });
          break;
        case $(e).hasClass('form-password'):
          jQuery.ajax({
            url: member_ajax_obj.ajax_url,
            type: 'POST',
            data: {
              action: 'handle_member_login',
              member_action: 'login',
              member_login_nonce: jQuery('#member_login_nonce').val(),
              member_username: $('#member_username_hidden').val(),
              member_password: $('#member_password').val()
            },
            success: function(response) {
              //console.log(response)
              if (response.success) {
                window.location.href = '/member/profile';
              } else {
                console.log(response);
                window.location.href = '/member/?status=failed';
              }
            },
            error: function(error) {
              console.log(error)
              window.location.href = '/member/?status=failed_login';

              return
            }
          })
          break;
        case $(e).hasClass('form-verify'):
          jQuery.ajax({
            url: member_ajax_obj.ajax_url,
            type: 'POST',
            data: {
              action: 'handle_member_verify_otp',
              member_login_nonce: jQuery('#member_login_nonce').val(),
              email: $('#member_username_hidden').val(),
              otp: $('#member_otp').val()
            },
            success: function(response) {
              //console.log(response)
              if (response.success) {
                $('.member-step-setpassword .login-display-image').attr('src', response.data.image);
                $('.member-step-setpassword .login-display-email').text(response.data.email);
                $('.member-step-setpassword .login-display-type').text(response.data.type);
                
                $('.member-step').each((i, step) => {
                  if ($(step).hasClass('member-step-setpassword')) {
                    $(step).removeClass('d-none');
                  } else {
                    $(step).addClass('d-none');
                  }
                })
              } else {
                console.log(response);
                window.location.href = '/member/?status=failed';
              }
            },
            error: function(error) {
              console.log(error)
              //indow.location.href = '/member/?status=failed_verify';

              return
            }
          })
          break;
        case $(e).hasClass('form-setpassword'):
          jQuery.ajax({
            url: member_ajax_obj.ajax_url,
            type: 'POST',
            data: {
              action: 'handle_member_setpassword',
              member_login_nonce: jQuery('#member_login_nonce').val(),
              email: $('#member_username_hidden').val(),
              password: $('#member_setpassword').val(),
              password_confirm: $('#member_setconfirm').val()
            },
            success: function(response) {
              //console.log(response)
              if (response.success) {
                jQuery.ajax({
                  url: member_ajax_obj.ajax_url,
                  type: 'POST',
                  data: {
                    action: 'handle_member_login',
                    member_action: 'login',
                    member_login_nonce: jQuery('#member_login_nonce').val(),
                    member_username: $('#member_username_hidden').val(),
                    member_password: $('#member_setpassword').val()
                  },
                  success: function(response) {
                    //console.log(response)
                    if (response.success) {
                      window.location.href = '/member/profile';
                    } else {
                      console.log(response);
                      window.location.href = '/member/?status=failed';
                    }
                  },
                  error: function(error) {
                    console.log(error)
                    window.location.href = '/member/?status=failed';

                    return
                  }
                })
              } else {
                console.log(response);
                window.location.href = '/member/?status=failed';
              }
            },
            error: function(error) {
              console.log(error)
              window.location.href = '/member/?status=failed_setpassword';

              return
            }
          })
          break;
        case $(e).hasClass('form-register'):
          const formData = new FormData();
          formData.append('action', 'handle_member_register');
          formData.append('member_login_nonce', $('#member_login_nonce').val());
          formData.append('MemberRegisterName', $('#member_register_name').val());
          formData.append('MemberRegisterEmail', $('#member_register_email').val());
          //formData.append('MemberRegisterPassword', $('#member_register_password').val());
          //formData.append('MemberRegisterPasswordConfirm', $('#member_register_password_confirm').val());

          const fileInput = $('#member_register_profile_image')[0];
          if (fileInput?.files.length > 0) {
            formData.append('MemberProfileImage', fileInput.files[0]);
          }

          jQuery.ajax({
            url: member_ajax_obj.ajax_url,
            type: 'POST',
            data: formData,
            processData: false, // do not convert to query string
            contentType: false, // let browser set multipart/form-data
            success: function(response) {
              //console.log(response);
              if (response.success) {
                $('#member_username_hidden').val($('#member_register_email').val());
                jQuery.ajax({
                    url: member_ajax_obj.ajax_url,
                    type: 'POST',
                    data: {
                      action: 'handle_member_suspended_otp',
                      member_login_nonce: jQuery('#member_login_nonce').val(),
                      email: $('#member_register_email').val()
                    },
                    success: function(response) {
                      if (response.success) {
                        $('.member-step-verify .login-display-email').text($('#member_register_email').val());
                        
                        if (fileInput?.files.length > 0) {
                          const file = fileInput.files[0];
                          const imageUrl = URL.createObjectURL(file);
                          $('.member-step-verify .login-display-image').attr('src', imageUrl);
                        }

                        $('.member-step').each((i, step) => {
                          if ($(step).hasClass('member-step-verify')) {
                            $(step).removeClass('d-none');
                          } else {
                            $(step).addClass('d-none');
                          }
                        })
                        
                      } else {
                        //window.location.href = '/member/?status=failed';
                      }
                    },
                    error: function(error) {
                      console.log(error)
                      //window.location.href = '/member/?status=failed';
                    }
                  })
              } else {
                console.log(response);
                //window.location.href = '/member/?status=failed';
              }
            },
            error: function(error) {
              console.log(error);
              //window.location.href = '/member/?status=failed';
            }
          });
          break;
        case $(e).hasClass('form-forgot'):
          jQuery.ajax({
            url: member_ajax_obj.ajax_url,
            type: 'POST',
            data: {
              action: 'get_member_data',
              member_login_nonce: jQuery('#member_login_nonce').val(),
              email: $('#member_forgot_username').val()
            },
            success: function(response) {
              if (response.success) {
                console.log(response.data.status)
                if(response.data.status !== 'banned') {
                  $('#member_username_hidden').val($('#member_forgot_username').val());
                  $('.member-step-verify .login-display-image').attr('src', response.data.image);
                  $('.member-step-verify .login-display-email').text(response.data.email);
                  $('.member-step-verify .login-display-type').text(response.data.type);

                  jQuery.ajax({
                    url: member_ajax_obj.ajax_url,
                    type: 'POST',
                    data: {
                      action: 'handle_member_suspended_otp',
                      member_login_nonce: jQuery('#member_login_nonce').val(),
                      email: $('#member_username_hidden').val()
                    },
                    success: function(response) {
                      if (response.success) {

                        $('.member-step').each((i, step) => {
                          if ($(step).hasClass('member-step-verify')) {
                            $(step).removeClass('d-none');
                          } else {
                            $(step).addClass('d-none');
                          }
                        })
                        
                      } else {
                        window.location.href = '/member/?status=failed_verify';
                      }
                    },
                    error: function(error) {
                      console.log(error)
                      window.location.href = '/member/?status=failed_verify';
                    }
                  })
                } else {
                  window.location.href = '/member/?status=' + response.data.status;
                  return;
                }
              }

            },
            error: function(error) {
              console.log(error)
              //window.location.href = '/member/?status=failed_login';

              return
            }
          });
          break;
        
      }
    })
  })

  $('.member-form button[data-to-step]').each((i, e) => {
    $(e).click(() => {
      const toStep = $(e).attr('data-to-step');

      const changeStep = () => {
          $('.member-step').each((i, step) => {
            if ($(step).hasClass(`member-step-${toStep}`)) {
              $(step).removeClass('d-none');
            } else {
              $(step).addClass('d-none');
            }
          })
      }

      changeStep();
    })
  })

  /* Wishlist */
  $('div.card-action-wishlist').each((i, e) => {
    $(e).click(() => {

      const memberAuth = document.cookie.split('; ').find(row => row.startsWith('member_auth='));
      if (memberAuth) {
        window.location.href = '/member/';
        return;
      }
      $(e).toggleClass('active');
      const postData = $(e).attr('data-select');
      const postDataObj = JSON.parse(postData);
      const isActive = $(e).hasClass('active') ? 1 : 0;

      jQuery.ajax({
        url: member_ajax_obj.ajax_url,
        type: 'POST',
        data: {
          action: 'toggle_wishlist',
          post_id: postDataObj.id,
          post_type: postDataObj.postType,
          is_active: isActive
        },
        success: function(response) {
          if (response.success) {
          } else {
            alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
          }
        },
        error: function() {
          $(e).toggleClass('active');
          alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
        }
      });
      
    });
  })
})

document.addEventListener('DOMContentLoaded', function() {
  const downloadBtn = document.getElementById('lead-downloadCSV');
  
  if (downloadBtn) {
    downloadBtn.addEventListener('click', function() {
      const table = document.querySelector('.wdl-member-lead-table-container table');
      if (!table) return;
      
      const rows = table.querySelectorAll('tr');
      const csvContent = [];
      
      rows.forEach(row => {
        const cells = row.querySelectorAll('th, td');
        const rowData = [];
        
        cells.forEach(cell => {
          const span = cell.querySelector('span');
          const text = span ? span.textContent : cell.textContent;
          // Escape quotes and wrap in quotes if contains comma
          const cleanText = text.replace(/"/g, '""');
          rowData.push('"' + cleanText + '"');
        });
        
        csvContent.push(rowData.join(','));
      });
      
      const csvString = csvContent.join('\n');
      const blob = new Blob(['\uFEFF' + csvString], { type: 'text/csv;charset=utf-8;' });
      
      const link = document.createElement('a');
      link.href = URL.createObjectURL(blob);
      link.download = downloadBtn.getAttribute('data-file-name');
      link.style.display = 'none';
      
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    });
  }
});