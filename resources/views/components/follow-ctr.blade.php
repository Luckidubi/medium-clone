 <div
{{ $attributes->merge(['class' => '']) }}
 x-data="{
     following: {{ $user->isFollowedBy(Auth::user()) ? 'true' : 'false' }},
     followersCount: {{ $user->followers->count() }},
     follow() {

         axios.post('/follow/{{ $user->id }}')
             .then(response => {
                 console.log(response.data.message)
                 this.following = !this.following
                 this.followersCount = response.data.follower_count
             })
             .catch(error => {
                 console.log(error)
             })
     }
 }" class="flex flex-col md:items-center items-start gap-1 md:gap-2">
     {{ $slot }}
 </div>
