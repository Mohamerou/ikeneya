import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PatientAreaComponent } from './patient-area.component';

describe('PatientAreaComponent', () => {
  let component: PatientAreaComponent;
  let fixture: ComponentFixture<PatientAreaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PatientAreaComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PatientAreaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
