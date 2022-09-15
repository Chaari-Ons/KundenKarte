import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {AuthGuardService} from './features/auth/services/auth.guard.service';

const routes: Routes = [
  { path: '', pathMatch: 'full', redirectTo: '/application' },
  { path: 'application', loadChildren: () => import('./core/core.module').then(m => m.CoreModule), canActivate: [AuthGuardService]},
  { path: 'auth', loadChildren: () => import('./features/auth/auth.module').then(m => m.AuthModule) },
  { path: '', pathMatch: 'full', redirectTo: 'application' },
  { path: '**', pathMatch: 'full', redirectTo: 'application' },

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
