<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tenner Bussiness</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href="{{ asset('assets2/css/all.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets2/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets2/css/style.css') }}" rel="stylesheet" type="text/css" />
  <style>
    .content {
      display: none;
    }

    #payment-content1 {
      display: block;
    }

    #previewModal .modal-dialog {
      max-width: 418px;
    }

    .modal .preview {
      max-width: 418px;
      padding: 22px;
      width: 100%;
    }
  </style>
</head>

<body>
  <header class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header-wrapper">
            <div class="header-logo"><a href="{{route('vendor.welcome')}}"><img src="{{ asset('assets2/images/logo.png')}}" alt="site logo"></a></div>
            <div class="header-btn"><a class="contact-btn" href="#">Contact Us</a></div>
          </div>
        </div>
      </div>
    </div>

  </header>
  <section class="profile-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="profile-wrapper">
            <div class=" profile-menu nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
              <button class="nav-link" id="tenner-promotion-tab" data-bs-toggle="tab" data-bs-target="#tenner-promotion" type="button" role="tab" aria-controls="tenner-promotion" aria-selected="false">Tenner Promotion</button>
            </div>
            <div class="profile-content tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="profile">
                  <div class="user-header">
                    <div class="user-image">
                      <!-- <img src="images/profile-image.png" alt="" /> -->
                      <img src="{{ asset('assets/admin/img/vendor-photo/' . Auth::guard('vendor')->user()->logo) }}" width="200" height="200" alt="" />
                      
                    </div>
                    <h3 class="user-title">{{Auth::guard('vendor')->user()->name}}</h3>
                  </div>
                  <div class="user-detail">
                    <ul class="list">
                      <li>
                        <div class="list-item">
                          <div class="title">Address</div>
                          <div class="description">{{Auth::guard('vendor')->user()->address}} <span class="address-note d-none">Inglewood, Maine 98380</span></div>
                        </div>
                      </li>
                      <li>
                        <div class="list-item">
                          <div class="title">Email</div>
                          <div class="description"><a href="#">{{Auth::guard('vendor')->user()->email}}</a></div>
                        </div>
                      </li>
                      <li>
                        <div class="list-item">
                          <div class="title">Phone</div>
                          <div class="description"><a href="#">{{ Auth::guard('vendor')->user()->phone }}</a></div>
                        </div>
                      </li>
                    </ul>
                    <div class="edit-btn">
                      <a class="site-btn bg-btn" href="edit.html">Edit</a>
                    </div>
                  </div>
                  <div class="user-info">
                    <ul class="list">
                      <li><a href="#" data-bs-toggle="modal" data-bs-target="#promotionModal">How to make a promotion</a></li>
                      <li><a href="#">Terms and Conditions and Privacy Policy</a></li>
                      <!-- <li><a href="#">Change Password</a></li> -->
                      <li><a href="#">Logout</a></li>
                      <!-- <li><a href="#">Delete Account</a></li> -->
                    </ul>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="tenner-promotion" role="tabpanel" aria-labelledby="tenner-promotion-tab" tabindex="0">
                <div class="promotion">
                  <form action="" class="site-form">
                    <div class="form-field">
                      <div class="form-switch-btn">
                        <label for="" class="form-label">Active/Inactive</label>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"  {{Auth::guard('vendor')->user()->EventOffer->status  == '1' ? 'checked' : ''}}>
                        </div>
                      </div>
                    </div>
                    <div class="form-field">
                      <label for="" class="form-label">Promotion Title</label>
                      <input type="text" class="form-control" id="" value="{{Auth::guard('vendor')->user()->EventOffer->offer_title ?? ''}}" placeholder="Write Promotion Title">
                    </div>
                    <!-- <div class="form-field">
                      <label for="" class="form-label">Promotion Title</label>
                      <input type="text" class="form-control" id="" placeholder="Write Promotion Title">
                      <span class="field-note">*18 character limit</span>
                    </div> -->
                    <div class="form-field">
                      <label for="" class="form-label">Promotion Deatils</label>
                      <textarea class="form-control" id="" placeholder="Write promotion details">{{Auth::guard('vendor')->user()->EventOffer->description ?? ''}}</textarea>
                      <span class="field-note">*120 character limit</span>
                    </div>
                    <div class="form-field m-0">
                      <label for="" class="form-label">Price Details</label>
                      <div class="payment-option">
                        <div class="payment-menu">
                          <label class="checkcontainer" for="payment-option1">Price Off
                            <input type="radio" id="payment-option1" name="radio" {{Auth::guard('vendor')->user()->EventOffer->offer_type  == 'old_new' ? 'checked' : ''}}>
                            <span class="radiobtn"></span>
                          </label>

                          <label class="checkcontainer" for="payment-option2">% off
                            <input type="radio" id="payment-option2" name="radio" {{Auth::guard('vendor')->user()->EventOffer->offer_type  == 'off' ? 'checked' : ''}}>
                            <span class="radiobtn"></span>
                          </label>

                          <label class="checkcontainer" for="payment-option3">Free
                            <input type="radio" id="payment-option3" name="radio" {{Auth::guard('vendor')->user()->EventOffer->offer_type  == 'free' ? 'checked' : ''}}>
                            <span class="radiobtn"></span>
                          </label>
                        </div>
                        <div class="payment-content">
                          <div class="content" id="payment-content1" style="display: block;">
                            <div class="grp-form-field">
                              <div class="form-field">
                                <label for="" class="form-label">Orginal Price</label>
                                <input type="text" class="form-control" value="{{Auth::guard('vendor')->user()->EventOffer->old_price ?? ''}}" id="" placeholder="Enter orginal price | $">
                                <span class="field-note">*3 character limit</span>
                              </div>
                              <div class="form-field">
                                <label for="" class="form-label">New Price</label>
                                <input type="text" class="form-control" value="{{Auth::guard('vendor')->user()->EventOffer->new_price ?? ''}}" placeholder="Enter New price | $">
                                <span class="field-note">*3 character limit</span>
                              </div>
                              <div class="form-field">
                              <label for="" class="form-label">% off</label>
                              <input type="text" class="form-control" id="" value="{{Auth::guard('vendor')->user()->EventOffer->discount_amount ?? ''}}"  placeholder="Enter Percentage | %">
                              <span class="field-note">*3 character limit</span>
                            </div>
                            </div>
                          </div>
                          <div class="content" id="payment-content2">
                            <div class="form-field">
                              <label for="" class="form-label">% off</label>
                              <input type="text" class="form-control" id="" value="{{Auth::guard('vendor')->user()->EventOffer->discount_amount ?? ''}}"  placeholder="Enter Percentage | %">
                              <span class="field-note">*3 character limit</span>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="form-field">
                      <label for="" class="form-label">Upload Photo or video (Optional)</label>
                      <div class="upload default-upload">
                        <p>please upload a photo or video that was taken with your phone vertically rather than horizontally; max size of 100MB</p>
                        <div class="file-input">
                          <label class="site-btn border-btn">
                            Choose File <input type="file" style="display: none;">
                          </label>
                          <span class="file-text">No File Chosen</span>
                        </div>
                      </div>
                      <div class="upload" style="display: none;">
                        <div class="upload-item">
                          <img src="images/upload-image.png" alt="" />
                          <a class="edit-btn" href="#">Replace</a>
                        </div>
                        <div class="upload-item-info">
                          <h6 class="item-title">Vedio_01.mp4</h6>
                          <p class="item-size">4.5 Mb</p>
                          <a class="remove-btn" href="#"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                      </div>
                    </div>
                    <div class="form-field">
                      <div class="grp-btns promotion-grp-btn">
                        <a class="site-btn border-btn" href="#" data-bs-toggle="modal" data-bs-target="#previewModal">Preview</a>
                        <a class="site-btn bg-btn" href="#">Publish</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- Promotion Modal -->
  <div class="modal fade" id="promotionModal" tabindex="-1" aria-labelledby="ppromotionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="promotion-card">
          <div class="card-heading">
            <h3 class="card-title">Welcome to Tenner Local Deals Business Management</h3>
            <a href="#" class="closing-btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></a>
          </div>
          <div class="welcome-video">
            <img class="img-fluid" src="images/video-image.jpg" alt="video cover image">
            <a class="video-btn" href="#"><i class="fa-solid fa-play"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Preview Modal -->
  <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="preview">
          <div class="preview-main-content">
            <div class="profile">
              <div class="user-header">
                <div class="user-image"><img src="images/profile-image.png" alt=""></div>
                <h3 class="user-title">Fauget Catering</h3>
              </div>
            </div>
            <div class="promo-content">
              <div class="promo-content-heading">
                <div class="title">Sandwich combo</div>
                <div class="pricing">
                  <span class="cut">$18</span>
                  $12
                </div>
              </div>
              <p class="description">Come in today and get a smoothie plus sandwch combo in 10% off for just $10, which
                resular
                price is $12</p>
              <div class="preview-info">
                <a class="like-btn" href="#"><i class="fa-solid fa-heart"></i></a>
                <a class="redeem-btn" href="#">Redeem Now</a>
              </div>
            </div>
          </div>
          <div class="preview-action-btn">
            <a class="site-btn border-btn" href="#">Edit</a>
            <a class="site-btn bg-btn" href="#">Publish</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- bootstrap js -->
  <script src="{{ asset('assets2/js/bootstrap.bundle.min.js') }}"></script>
  <script>
    /*   document.addEventListener("DOMContentLoaded", function () {
            var checkedRadio = document.querySelector('input[type="radio"]:checked');
            if (checkedRadio) {
                var contentId = checkedRadio.id.replace('payment-option', 'payment-content');
                document.getElementById(contentId).style.display = 'block';
            }
        });

        // Change content when a radio button is clicked
        document.querySelectorAll('input[type="radio"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                var contentId = this.id.replace('payment-option', 'payment-content');
                document.querySelectorAll('.payment-content .payment-content-inner').forEach(function (content) {
                    content.style.display = 'none';
                });
                document.getElementById(contentId).style.display = 'block';
            });
        });*/
    // new code
    document.addEventListener('DOMContentLoaded', function() {
      // Radio buttons ke changes ko handle karne ke liye function
      function handleRadioChange(event) {
        // Sabhi content divs ko initially hide kar dena
        const allContents = document.querySelectorAll('.payment-content .content');
        allContents.forEach(content => {
          content.style.display = 'none';
        });

        // Match karne wale content ID ko based on selected radio button
        const selectedContentId = 'payment-content' + event.target.id.charAt(event.target.id.length - 1);
        const selectedContent = document.getElementById(selectedContentId);
        if (selectedContent) {
          selectedContent.style.display = 'block';
        }
      }

      // Sabhi radio buttons ke liye event listeners add karna
      const radioButtons = document.querySelectorAll('.payment-menu input[type="radio"][name="radio"]');
      radioButtons.forEach(radio => {
        radio.addEventListener('change', handleRadioChange);
      });
    });
  </script>
</body>

</html>