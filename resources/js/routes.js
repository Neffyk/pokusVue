import Tournaments from './components/Tournaments.vue'
import Home from './components/Home.vue'
import SingleTournament from './components/SingleTournament.vue'
import AddTournament from './components/AddTournament.vue'
import Rankings from './components/Rankings.vue'
import Login from './components/Login.vue'
import Register from './components/Register.vue'
import Logout from './components/Logout.vue'
import Users from './components/Users.vue'
import MineTournament from './components/MineTournament.vue'
import RateTournament from './components/RateTournament.vue'




export default [
    {
        path :'/tournaments' ,
        name:'tournaments',
        component:Tournaments,
        meta:{
            requiresAuth:true,
        }
    },
    {
        path :'/home',
        name:'home',
        component: Home,
        meta:{
            requiresAuth:true,
        }
    },
    {
        path :'/tournament/:id' ,
        name:'tournament',
        component: SingleTournament,
        meta:{
            requiresAuth:true,
        }
    },
    {
        path :'/addTournament' ,
        name:'addTournament',
        component:AddTournament,
        meta:{
            requiresAdmin:true,
        }
    },
    {
        path :'/mineTournament' ,
        name:'mineTournament',
        component:MineTournament,
        meta:{
            requiresAuth:true,
        }
    },
    {
        path :'/rankings',
        name:'rankings',
        component:Rankings,
        meta:{
            requiresAuth:true,
        }
    },
    {
        path :'/users',
        name:'users',
        component:Users,
        meta:{
            requiresAdmin:true,
        }
    },
    {
        path :'/rateTournament/:id',
        name:'rateTournament',
        component:RateTournament,
        meta:{
            requiresAdmin:true,
        }
    },
    {
        path :'/login',
        name:'login',
        component:Login,
        props:true,
        meta:{
            requiresVisitor:true,
        }

    },
    {
        path :'/register',
        name:'register',
        component:Register,
        meta:{
            requiresVisitor:true,
        }
    },
    {
        path :'/logout',
        name:'logout',
        component:Logout,
        meta:{
            requiresAuth:true,
        }
    },
]
