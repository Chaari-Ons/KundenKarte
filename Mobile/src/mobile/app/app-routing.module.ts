import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import {LoginGuard} from "./guard/login.guard";
import {LoginComponent} from "./features/auth/components/login/login.component";
import {LogoutGuard} from "./guard/logout.guard";

const routes: Routes = [
  //{ path: '', pathMatch: 'full', redirectTo: '/home',canActivate: [LoginGuard]},
  { path: '', loadChildren: () => import('./features/auth/auth.module').then(m => m.AuthModule)},
  { path: 'home', loadChildren: () => import('./tabs/tabs.module').then(m => m.TabsPageModule), canActivate: [LoginGuard]},
  { path: 'settings', loadChildren: () => import('./features/settings/settings.module').then(m => m.SettingsModule),canActivate: [LoginGuard]},
  { path: '**', component: LoginComponent},

];
@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
