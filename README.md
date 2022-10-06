<!-- Make A Port -->
php artisan serve --port=8080
<!-- Route List -->
php artisan route:list

Change Log

MEL-01
<br>~database + seed

MEL-01-fix
<br>~fix database + seed

MEL-02
<br>~Make Login & Register
<br>~Make Middleware Role
<br>~Make Authorization Role Admin & User
<br>~Change FILESYSTEM_DISK (filesystems.php) to public (with .env)
<br>~Make Storage Public with php artisan storage:link
<br>~Make Profile Page & Upload Profile Picture

MEL-03
<br>~Make Users List 
<br>~Half Finished Profile Page
<br>~Add User Setting
<br>~Add User List

MEL-04
<br>~Add Dashboard Page
<br>~Reworked V2 database migration + Seeder
<br>~Setting Profile V1

MEL-05
<br>~All Dashboard Finish except favorite, review, comment
<br>~Reworked V3 database migration + Seeder (add unique 2 column)
<br>~Set youtube link upload & stream 
<br>~Set upload image

MEL-06
<br>~Community -> Forums Progress 90%
<br>~Events
<br>~Home Progress 90%

MEL-07 
<br>~Edit Review & Comment backend DONE
<br>~Page People & Characters
<br>~Create post and redirect

MEL-08
<br>~Fix dashboard Topic
<br>~Fix dashboard Posts
<br>~Folder Change for post views from forums to forum->post 
<br>~Create post without event (hide event) (Just Event Schedules has event option)
<br>~Search Events, People, Characters, Users, and Searching All
<br>~Add Remove Image in edit Post
<br>~Delete Post and redirect to topic
<br>~Anchor for events frontend


MEL-09
<br>~Update Review & Comment CSS Finale
<br>~delete view more in people and characters (dashboard too)
<br>~Post dashboard disable button edit from another user 
<br>~Change database picture to nullable (delete default value)
<br>~Search event with location
<br>~Event Show & dashboard event add more page reviews, characters
<br>~Dashboard event (100% I think)
<br>~Add Search in Actor, Actor-Event, Category
<br>~Dashboard character (100% I think)
<br>~Event Show Color last (dashboard default)
<br>~Remove image in edit [dashboard(event, character)]
<br>~Dashboard actor (100% I think)
<br>~Dashboard actor-events (100% I think)
<br>~Dashboard People (100% I think)
<br>~Dashboard Post (100%)
<br>~when update not delete old image Fix (old_Picture to oldPicture)
<br>~Dashboard Topic (100%)
<br>~Dashboard Worker/Staff (100%)
<br>~Index Limit(Workers)
<br>~Update dashboard page => Image null (people, characters, events, posts) Done
<br>~[Done] Limit Text in dashboard index (Important)
<br>~Backend Search Done

MEL-10
<br>~Dashboard Home 
<br>~Search All Fix Image
<br>~New Search .deleteIconLong for long width search
<br>~CSS card events, people, characters (index) Done
<br>~Show People Finish & some change in dashboard show people
<br>~Show Characters Finish
<br>~Profile Favorite and Post not Done
<br>~Check unique event at people and characters in frontend Done
<br>~css score and favorited in events already done in MEL-09
<br>notif success and fail not implement in frontend (review, comment, edit post) and maybe some backend (backend OK)
<br>~Landing Page (HOME) DONE
<br>~Add Phone Number in event Show(forgot before)
<br>~event synopsis ganti description
<br>~Seeder Finish
<br>~Actor Event dan Character Controller
<br>~Actor Event dan Character search(Done)
<br>~Actor Event dan Character index, create, update (Done)
<br>~Date seeder tahunnya blom bener(Done)




``php artisan migrate:fresh --seed --seeder=UserSeeder
- To Do

<!-- ! Role pindah dari characters ke actor-character document coding erd all -->
<document yang belum diganti rolenya yaitu desain antarmuka> [DONE]
<Event Chara dan Reviews udah dibuat di figma tinggal nambahin di doc> [Done 10 Menit]

<Role coding>
~return to_route (downgrade laravel)

Change Latest show all

DOC
event synopsis ganti description DOCUMENT [Done]
check Gambar 4 blabla (Kapital diawal) [Done]
Update nomer gambar bab 4 masih males tiap 1 jam ganti anjg [Done]

Ganti SS angklung Carehal (Show Event)
Give minimum value body(Post Done) (document)
review free lah jangan maksa DOC
<br>reviews tanpa minimal text (check document)
Hapus minimum value di review