import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TabsPage } from './tabs.page';
import {LoginGuard} from "../guard/login.guard";

const routes: Routes = [
  {
    path: '',
    component: TabsPage,
    children: [
      {
        path: 'prospekte',
        loadChildren: () => import('../tab-brochures/tab-brochures.module').then(m => m.TabBrochuresPageModule)
      },
      {
        path: 'meine-karten',
        loadChildren: () => import('../tab-card/tab-card.module').then(m => m.TabCardPageModule)
      },
      {
        path: 'tab3',
        loadChildren: () => import('../tab3/tab3.module').then(m => m.Tab3PageModule)
      },
      { path: '', pathMatch: 'full', redirectTo: 'prospekte'},
    ]
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
})
export class TabsPageRoutingModule {}
