import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {TabBrochuresPage} from './tab-brochures.page';
import {ListBrochuresComponent} from './components/list-brochures/list-brochures.component';
import {CatalogueComponent} from './components/catalogue/catalogue.component';

const routes: Routes = [
  {
    path: '',
    component: TabBrochuresPage,
    children: [{
      path: '',
      component: ListBrochuresComponent
      },
      {
        path: ':url',
        component: CatalogueComponent
      },
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TabBrochuresPageRoutingModule {}
