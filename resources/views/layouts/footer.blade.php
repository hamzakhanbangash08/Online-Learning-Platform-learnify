  <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">{!! setting('footer_text', '© '.date('Y').' '.config('app.name')) !!}</span>
            </div>
          </footer>
        

@php $social = setting('social_links', []); @endphp

@if(!empty($social['facebook'])) <a href="{{ $social['facebook'] }}" target="_blank"><i class="fab fa-facebook"></i></a> @endif
@if(!empty($social['linkedin'])) <a href="{{ $social['linkedin'] }}" target="_blank"><i class="fab fa-linkedin"></i></a> @endif
@if(!empty($social['twitter']))  <a href="{{ $social['twitter'] }}"  target="_blank"><i class="fab fa-twitter"></i></a> @endif
