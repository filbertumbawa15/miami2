@extends('guest.layouts.app')

@section('content')
<div id="content">
  <div class="bg4 p9">
    <div class="container">
      <div class="row">
        <div class="grid_8 wrap">
          <h2>stay in touch</h2>
          <div class="map">
            <iframe class="map_c" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d24214.807650104907!2d-73.94846048422478!3d40.65521573400813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1395650655094" style="border:0"></iframe>
          </div>
          <div class="grid_3 alpha wrap">
            <address class="address1">
              <p>8901 Marmora Road, <br>Glasgow, D04 89GR.</p>
              <dl>
                <dt></dt>
                <dd>Freephone: <span>+1 800 559 6580</span></dd>
                <dd>Telephone: <span>+1 959 603 6035</span></dd>
                <dd>FAX: <span>+1 504 889 9898</span></dd>
                <dd>E-mail:&nbsp;<span><a href="index-4.html#">mail@demolink.org</a></span></dd>
              </dl>
            </address>
          </div>
          <div class="grid_5 omega">
            <address class="address1">
              <p>9863 - 9867 Mill Road, <br>Cambridge, MG09 99HT.</p>
              <dl>
                <dt></dt>
                <dd>Freephone: <span>+1 800 559 6580</span></dd>
                <dd>Telephone: <span>+1 959 603 6035</span></dd>
                <dd>FAX: <span>+1 504 889 9898</span></dd>
                <dd>E-mail:&nbsp;<span><a href="index-4.html#">mail@demolink.org</a></span></dd>
              </dl>
            </address>
          </div>
        </div>
        <div class="grid_4">
          <h2>Contact form</h2>
          <form id="contact-form">
            <div class="contact-form-loader"></div>
            <fieldset>
              <label class="name">
                <input type="text" name="name" placeholder="Name:" value="" data-constraints="@Required @JustLetters" />
                <span class="empty-message">*This field is required.</span>
                <span class="error-message">*This is not a valid name.</span>
              </label>
              <label class="email">
                <input type="text" name="email" placeholder="E-mail:" value="" data-constraints="@Required @Email" />
                <span class="empty-message">*This field is required.</span>
                <span class="error-message">*This is not a valid email.</span>
              </label>
              <label class="phone">
                <input type="text" name="phone" placeholder="Phone:" value="" data-constraints="@Required @JustNumbers" />
                <span class="empty-message">*This field is required.</span>
                <span class="error-message">*This is not a valid phone.</span>
              </label>
              <label class="message">
                <textarea name="message" placeholder="Message:" data-constraints='@Required @Length(min=20,max=999999)'>
                                    </textarea>
                <span class="empty-message">*This field is required.</span>
                <span class="error-message">*The message is too short.</span>
              </label>
              <!-- <label class="recaptcha"><span class="empty-message">*This field is required.</span></label> -->
              <div class="btns">
                <a href="index-4.html#" class="link" data-type="reset">reset</a>
                <a href="index-4.html#" class="link" data-type="submit">submit</a>
              </div>
            </fieldset>
            <div class="modal fade response-message">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Modal title</h4>
                  </div>
                  <div class="modal-body">
                    You message has been sent! We will be in touch soon.
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection