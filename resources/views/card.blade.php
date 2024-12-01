<div class="brewery-grid">
            @foreach($breweries as $brewery)
                <div class="brewery-card">
                    <!-- Placeholder image -->
                    <img src="./images/beer.png" alt="{{ $brewery['name'] }}">
                    <div class="brewery-title">{{ $brewery['name'] }}</div>
                    <!-- Brewery info displayed on hover -->
                    <div class="brewery-info">
                        <p>Type: {{ $brewery['brewery_type'] }}</p>
                        <p>City: {{ $brewery['city'] }}</p>
                        <p>State: {{ $brewery['state'] }}</p>
                        @if($brewery['website_url'])
                            <a href="{{ $brewery['website_url'] }}" target="_blank" class="btn btn-sm btn-light mt-2">Visit</a>
                        @else
                            <p>No website</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
