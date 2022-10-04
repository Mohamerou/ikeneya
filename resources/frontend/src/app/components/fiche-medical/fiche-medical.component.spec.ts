import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FicheMedicalComponent } from './fiche-medical.component';

describe('FicheMedicalComponent', () => {
  let component: FicheMedicalComponent;
  let fixture: ComponentFixture<FicheMedicalComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FicheMedicalComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(FicheMedicalComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
