$(document).ajaxError((event, jqxhr, settings, thrownError) => {
  switch (jqxhr.status) {
    case 401:
      fireToast('error', jqxhr.statusText, jqxhr.responseJSON.message)
      break;

    default:
      break;
  }
})

function setErrorMessages(form, errors = {}) {
  let errorKeys = Object.keys(errors)

  $.each(errors, function (error) {
    let invalidFeedback = document.createElement('div')
    invalidFeedback.className = 'invalid-feedback'
    invalidFeedback.innerHTML = errors[error]

    form.find(`[name=${error}]`)
      .addClass('is-invalid')
      .after(invalidFeedback)
  })

  if (firstElement = form.find(`[name=${errorKeys[0]}]`)) {
    firstElement.focus()
  }
}

function clearErrorMessages(form) {
  form.find('.is-invalid').removeClass('is-invalid')
  form.find('.invalid-feedback').remove()
}

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

function fireToast(icon, title = '', text = '') {
  Toast.fire({
    icon: icon,
    title: title,
    text: text,
  })
}

function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2)
    return parts.pop().split(';').shift();
}