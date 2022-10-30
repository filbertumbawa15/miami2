const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

$(document).ajaxError((event, jqXHR, ajaxSettings, thrownError) => {
  if (jqXHR.status !== 422) {
    fireToast('error', thrownError, jqXHR.responseJSON.message)
  }
  // switch (jqXHR.status) {
  //   case 401:

  //     fireToast('error', thrownError, jqXHR.responseJSON.message)
  //     break;
  //   case 500:

  //     fireToast('error', thrownError, jqXHR.responseJSON.message)
  //     break;
  //   default:
  //     break;
  // }
})

function fireToast(icon = '', title = '', text = '') {
  Toast.fire({
    icon: icon,
    title: title,
    text: text,
  })
}

function setErrorMessages(form, errors = {}) {
  let errorKeys = Object.keys(errors)

  errorKeys.forEach(error => {
    let invalidFeedback = document.createElement('div')
    invalidFeedback.className = 'invalid-feedback'
    invalidFeedback.innerHTML = errors[error]

    form.find(`[name=${error}]`)
      .addClass('is-invalid')
      .after(invalidFeedback)
  });

  if (firstElement = form.find(`[name=${errorKeys[0]}]`)) {
    firstElement.focus()
  }
}