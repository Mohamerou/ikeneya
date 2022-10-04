import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { HomeComponent } from './components/home/home.component';
import { PreloaderComponent } from './components/preloader/preloader.component';
import { BannerComponent } from './components/banner/banner.component';
import { FeatureComponent } from './components/feature/feature.component';
import { WelcomeAreaComponent } from './components/welcome-area/welcome-area.component';
import { PatientAreaComponent } from './components/patient-area/patient-area.component';
import { SpecialistAreaComponent } from './components/specialist-area/specialist-area.component';
import { HotlineAreaComponent } from './components/hotline-area/hotline-area.component';
import { LoginComponent } from './components/auth/login/login.component';
import { UserComponent } from './components/user/user.component';
import { NavbarComponent } from './components/navbar/navbar.component';
import { RegisterComponent } from './components/auth/register/register.component';
import { FicheMedicalComponent } from './components/fiche-medical/fiche-medical.component';
import { SubscriptionComponent } from './components/subscription/subscription.component';
import { DoctorRegistrationComponent } from './components/doctor-registration/doctor-registration.component';
import { SidebarComponent } from './components/sidebar/sidebar.component';
import { BlogComponent } from './components/blog/blog.component';
import { PartenaireComponent } from './components/partenaire/partenaire.component';
import { NosDocteursComponent } from './components/nos-docteurs/nos-docteurs.component';
import { ContactComponent } from './components/contact/contact.component';

const appRoutes: Routes = [
  {path: 'connexion', component:LoginComponent},
  {path: 'nouveau-utilisateur', component:RegisterComponent},
  {path: 'partenaires', component:PartenaireComponent},
  {path: 'nos-docteurs', component:NosDocteursComponent},
  {path: 'abonnement', component:SubscriptionComponent},
  {path: 'contact', component:ContactComponent},
  {path: 'blog', component:BlogComponent},
  {path: 'nouveau-medecin', component:DoctorRegistrationComponent},
  {path: 'create-fiche-medicale', component:FicheMedicalComponent},
  {path: 'abonnement', component:SubscriptionComponent},
  {path: '', component:HomeComponent},
  {path: '**', redirectTo: '', pathMatch: 'full'}
];
@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    HomeComponent,
    PreloaderComponent,
    BannerComponent,
    FeatureComponent,
    WelcomeAreaComponent,
    PatientAreaComponent,
    SpecialistAreaComponent,
    HotlineAreaComponent,
    LoginComponent,
    UserComponent,
    NavbarComponent,
    RegisterComponent,
    FicheMedicalComponent,
    SubscriptionComponent,
    DoctorRegistrationComponent,
    SidebarComponent,
    BlogComponent,
    PartenaireComponent,
    NosDocteursComponent,
    ContactComponent,
  ],
  imports: [
    BrowserModule,
    RouterModule.forRoot(appRoutes),
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
