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
    input#flexSwitchCheckChecked {
      background-color: red;
    }

    input#flexSwitchCheckChecked:checked {
      background-color: green;
    }
  </style>
</head>

<body>
  <header class="main-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="header-wrapper">
            <div class="header-logo"><a href="{{route('vendor.profile_v2')}}"><img src="{{ asset('assets2/images/logo.png')}}" alt="site logo"></a></div>
            <div class="header-btn"><a class="contact-btn" href="#">Contact Us</a></div>
          </div>
        </div>
      </div>
    </div>

  </header>
  <section class="profile-section">
    <div class="container">
      <div class="row">
        <div class="col-12">

          @if(session('danger'))
          <div class="alert alert-danger">
            {{ session('danger') }}
          </div>
          @endif

          @foreach($errors->all() as $error)
          <div class="alert alert-danger">{{ $error }}</div>
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif
        </div>
        <div class="col-12">
          @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif
        </div>

      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="profile-wrapper">
            <div class=" profile-menu nav nav-tabs" id="nav-tab" role="tablist">
              <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
              <button class="nav-link" id="tenner-promotion-tab" data-bs-toggle="tab" data-bs-target="#tenner-promotion" type="button" role="tab" aria-controls="tenner-promotion" aria-selected="false">Tenner Promotion</button>
            </div>
            <div class="profile-content tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <div class="edit-profile">
                  <form action="{{route('store.vendor.profile_v2')}}" class="site-form" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-field">
                      <label for="" class="form-label">Business Name</label>
                      <input type="text" class="form-control" name="name" value="{{Auth::guard('vendor')->user()->name}}" placeholder="Enter Business Name">
                      <span class="field-note">*50 character limit</span>
                    </div>
                    <div class="form-field">
                      <label for="" class="form-label">Upload Business Logo</label>
                      <div class="file-upload">
                        <div class="file-upload-preview">
                          <i class="fa-regular fa-image"></i>
                        </div>
                        <div class="file-upload-content">
                          <p class="note">Please upload an image, Max size of 100MB</p>
                          <div class="file-input">
                            <label class="site-btn">
                             <input type="file" name="logo">
                            </label>
                          
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-field">
                      <label for="" class="form-label">Business Phone Number</label>
                      <div style="display: flex;flex-direction: row;gap:5%">
                        <input type="text" name="phone" value="{{Auth::guard('vendor')->user()->phone}}" class="form-control" id="" placeholder="Enter Business Address">

                        <!-- <input style="padding: 10px;width: 10%;" type="text"   value="{{Auth::guard('vendor')->user()->phone}}" class="form-control" name="phone"> -->

                      </div>
                    </div>
                    <div class="form-field">
                      <label for="" class="form-label">Select Address</label>
                      <input type="text" name="address" value="{{Auth::guard('vendor')->user()->address}}" class="form-control" id="" placeholder="Enter Business Address">
                    </div>
                    <div class="form-field">
                      <div class="form-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2990.274257380938!2d-70.56068388481569!3d41.45496659976631!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e52963ac45bbcb%3A0xf05e8d125e82af10!2sDos%20Mas!5e0!3m2!1sen!2sus!4v1671220374408!5m2!1sen!2sus" width="100%" height="290" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                      </div>
                    </div>
                    <div class="form-field m-0">
                      <div class="grp-btns edit-grp-btn">
                        <a class="site-btn border-btn" href="#">Cancel</a>
                        <button class="site-btn bg-btn" type="submit" name="profile">Save</button>
                      </div>
                    </div>

                </div>
              </div>
              <div class="tab-pane fade" id="tenner-promotion" role="tabpanel" aria-labelledby="tenner-promotion-tab" tabindex="0">
                <div class="promotion site-form">

                  <div class="form-field">
                    <div class="form-switch-btn">
                      <label for="" class="form-label">Active/Inactive</label>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{Auth::guard('vendor')->user()->EventOffer->status ?? ''  == '1' ? 'checked' : ''}}>
                      </div>
                    </div>
                  </div>
                  <div class="form-field">
                    <label for="" class="form-label">Promotion Title</label>
                    <input type="text" class="form-control" id="" value="{{Auth::guard('vendor')->user()->EventOffer->offer_title ?? ''}}" name="offer_title" placeholder="Write Promotion Title">
                  </div>
                  <!-- <div class="form-field">
                      <label for="" class="form-label">Promotion Title</label>
                      <input type="text" class="form-control" id="" placeholder="Write Promotion Title">
                      <span class="field-note">*18 character limit</span>
                    </div> -->
                  <div class="form-field">
                    <label for="" class="form-label">Promotion Deatils</label>
                    <textarea class="form-control" id="" placeholder="Write promotion details" name="description">{{Auth::guard('vendor')->user()->EventOffer->description ?? ''}}</textarea>
                    <span class="field-note">*120 character limit</span>
                  </div>
                  <div class="form-field m-0">
                    <label for="" class="form-label">Price Details</label>
                    <div class="payment-option">
                      <div class="payment-menu">
                        <label class="checkcontainer" for="payment-option1">Price Off
                          <input type="radio" id="payment-option1" name="offer_type" value="old_new" {{Auth::guard('vendor')->user()->EventOffer->offer_type ?? ''  == 'old_new' ? 'checked' : ''}}>
                          <span class="radiobtn"></span>
                        </label>

                        <label class="checkcontainer" for="payment-option2">% off
                          <input type="radio" id="payment-option2" name="offer_type" value="off" {{Auth::guard('vendor')->user()->EventOffer->offer_type ?? ''  == 'off' ? 'checked' : ''}}>
                          <span class="radiobtn"></span>
                        </label>

                        <label class="checkcontainer" for="payment-option3">Free
                          <input type="radio" id="payment-option3" name="offer_type" value="free" {{Auth::guard('vendor')->user()->EventOffer->offer_type ?? ''  == 'free' ? 'checked' : ''}}>
                          <span class="radiobtn"></span>
                        </label>
                      </div>
                      <div class="payment-content">
                        <div class="content" id="payment-content1" style="display: block;">
                          <div class="grp-form-field">
                            <div class="form-field">
                              <label for="" class="form-label">Orginal Price</label>
                              <input type="text" class="form-control" name="old_price" value="{{Auth::guard('vendor')->user()->EventOffer->old_price ?? ''}}" id="" placeholder="Enter orginal price | $">
                              <span class="field-note">*3 character limit</span>
                            </div>
                            <div class="form-field">
                              <label for="" class="form-label">New Price</label>
                              <input type="text" class="form-control" name="new_price" value="{{Auth::guard('vendor')->user()->EventOffer->new_price ?? ''}}" placeholder="Enter New price | $">
                              <span class="field-note">*3 character limit</span>
                            </div>
                            <div class="form-field">
                              <label for="" class="form-label">% off</label>
                              <input type="text" class="form-control" name="discount_amount" value="{{Auth::guard('vendor')->user()->EventOffer->discount_amount ?? ''}}" placeholder="Enter Percentage | %">
                              <span class="field-note">*3 character limit</span>
                            </div>
                          </div>
                        </div>
                        <!-- <div class="content" id="payment-content2">
                            <div class="form-field">
                              <label for="" class="form-label">% off</label>
                              <input type="text" class="form-control" id="" value="{{Auth::guard('vendor')->user()->EventOffer->discount_amount ?? ''}}"  placeholder="Enter Percentage | %">
                              <span class="field-note">*3 character limit</span>
                            </div>
                          </div> -->

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
                      <a class="site-btn border-btn" href="{{route('vendor.profile_v2_edit')}}">Preview</a>
                      <button class="site-btn bg-btn" name="publish" type="submit">Publish</button>
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
  <!-- jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- bootstrap js -->
  <script src="{{ asset('assets2/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>