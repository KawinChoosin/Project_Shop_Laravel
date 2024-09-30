<div style="text-align: center; margin: 20px 0;">
        <a href="{{ url('/') }}" 
           class="btn {{ isset($categoryName) && $categoryName === 'all' ? 'btn-primary' : 'btn-outline-primary' }}" 
           style="margin: 0 15px; text-decoration: none;">ALL</a>

        <a href="{{ url('/?category=sports') }}" 
           class="btn {{ isset($categoryName) && $categoryName === 'sports' ? 'btn-primary' : 'btn-outline-primary' }}" 
           style="margin: 0 15px; text-decoration: none;">SPORTS</a>

        <a href="{{ url('/?category=cloths') }}" 
           class="btn {{ isset($categoryName) && $categoryName === 'cloths' ? 'btn-primary' : 'btn-outline-primary' }}" 
           style="margin: 0 15px; text-decoration: none;">CLOTHS</a>

        <a href="{{ url('/?category=electronics') }}" 
           class="btn {{ isset($categoryName) && $categoryName === 'electronics' ? 'btn-primary' : 'btn-outline-primary' }}" 
           style="margin: 0 15px; text-decoration: none;">ELECTRONICS</a>
    </div>
