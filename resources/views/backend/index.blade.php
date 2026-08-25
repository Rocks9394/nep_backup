@extends('layouts.backend.dashboard_layout')

@section('content')

<div class="kpi-grid">
  <div class="kpi-card">
    <div class="kpi-label">All time sales <i class="far fa-calendar-alt"></i></div>
    <div class="kpi-value">$295.7k</div>
    <span class="kpi-change"><i class="fas fa-arrow-up"></i> +2.7%</span>
  </div>
  <div class="kpi-card">
    <div class="kpi-label">Public Profile</div>
    <div class="kpi-value">$172k</div>
    <span class="kpi-change"><i class="fas fa-arrow-up"></i> 3.9%</span>
  </div>
  <div class="kpi-card">
    <div class="kpi-label">My Account</div>
    <div class="kpi-value">$85k</div>
    <span class="kpi-change"><i class="fas fa-arrow-up"></i> 0.7%</span>
  </div>
  <div class="kpi-card">
    <div class="kpi-label">Network</div>
    <div class="kpi-value">$36k</div>
    <span class="kpi-change negative"><i class="fas fa-arrow-down"></i> 8.2%</span>
  </div>
</div>

<!-- row two: chart + social -->
<div class="row-two">
  <div class="chart-card">
    <div class="chart-header">
      <h4>Earnings overview</h4>
      <span class="chart-badge">1 month</span>
    </div>
    <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 10px;">
      <div><span style="font-weight: 500; color: #0f172a; transition: 0.2s;" class="earning-total">$295.7k</span> <span style="color: #64748b; font-size: 13px;">+2.7%</span></div>
    </div>
    <div class="chart-bars">
      <div class="bar-wrapper"><div class="bar" style="height: 32px;"></div><span class="bar-label">Jan</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 48px;"></div><span class="bar-label">Feb</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 62px;"></div><span class="bar-label">Mar</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 44px;"></div><span class="bar-label">Apr</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 76px;"></div><span class="bar-label">May</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 58px;"></div><span class="bar-label">Jun</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 90px;"></div><span class="bar-label">Jul</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 70px;"></div><span class="bar-label">Aug</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 100px;"></div><span class="bar-label">Sep</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 84px;"></div><span class="bar-label">Oct</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 46px;"></div><span class="bar-label">Nov</span></div>
      <div class="bar-wrapper"><div class="bar" style="height: 64px;"></div><span class="bar-label">Dec</span></div>
    </div>
  </div>

  <!-- Social stats -->
  <div class="social-stats">
    <div class="social-item">
      <div class="social-left"><i class="fab fa-facebook-f"></i><span>Facebook</span></div>
      <div class="social-right"><div class="amount">$85k</div><div class="percent">0.7%</div></div>
    </div>
    <div class="social-item">
      <div class="social-left"><i class="fab fa-instagram"></i><span>Instagram</span></div>
      <div class="social-right"><div class="amount">$36k</div><div class="percent negative">-8.2%</div></div>
    </div>
    <div class="social-item">
      <div class="social-left"><i class="fas fa-shopping-bag"></i><span>Store</span></div>
      <div class="social-right"><div class="amount">$172k</div><div class="percent">3.9%</div></div>
    </div>
    <div class="social-item">
      <div class="social-left"><i class="fas fa-globe"></i><span>Network</span></div>
      <div class="social-right"><div class="amount">$60k</div><div class="percent">2.1%</div></div>
    </div>
  </div>
</div>

<!-- bottom: team & apps -->
<div class="bottom-grid">
  <div class="team-card">
    <div class="card-header">
      <h4>Team <span style="font-weight: 400; font-size:14px; color:#64748b;">· Rating</span></h4>
      <i class="fas fa-ellipsis-h"></i>
    </div>
    <div class="team-row">
      <div class="team-avatar">JD</div>
      <div class="team-info"><div class="name">John Doe</div><div class="meta">Product testing</div></div>
      <div class="time">09:00-09:30</div>
      <span class="badge-qa">QA</span>
    </div>
    <div class="team-row">
      <div class="team-avatar">SM</div>
      <div class="team-info"><div class="name">Sarah Miles</div><div class="meta">Quality Assurance</div></div>
      <div class="time">25 Sep, 2024</div>
      <span class="badge-qa">QA</span>
    </div>
    <div class="team-row">
      <div class="team-avatar">AK</div>
      <div class="team-info"><div class="name">Alex Kim</div><div class="meta">Team meeting</div></div>
      <div class="time">Last Modified</div>
      <span class="badge-qa">Members</span>
    </div>
    <div style="margin-top: 12px; color: #3b82f6; font-weight: 500; font-size:14px; display: flex; gap: 10px;">
      <span><i class="fas fa-users"></i> Teams</span>
      <span><i class="fas fa-search"></i> QSearch Teams...</span>
    </div>
  </div>

  <div class="apps-card">
    <div class="card-header">
      <h4>Apps & Tools</h4>
      <i class="fas fa-ellipsis-h"></i>
    </div>
    <div class="app-item">
      <div class="app-icon"><i class="fas fa-store"></i></div>
      <div class="app-name">Store-Client</div>
      <div class="app-status"><i class="fas fa-check-circle"></i> Active</div>
    </div>
    <div class="app-item">
      <div class="app-icon"><i class="fas fa-user-shield"></i></div>
      <div class="app-name">Store-Admin</div>
      <div class="app-status soon"><i class="fas fa-clock"></i> Soon</div>
    </div>
    <div class="app-item">
      <div class="app-icon"><i class="fas fa-concierge-bell"></i></div>
      <div class="app-name">Store-Services</div>
      <div class="app-status soon"><i class="fas fa-clock"></i> Soon</div>
    </div>
    <div class="app-item">
      <div class="app-icon"><i class="fas fa-file-invoice"></i></div>
      <div class="app-name">Invoice Generator</div>
      <div class="app-status soon"><i class="fas fa-clock"></i> Soon</div>
    </div>
    <div class="app-item">
      <div class="app-icon"><i class="fas fa-robot"></i></div>
      <div class="app-name">AI Prompt</div>
      <div class="app-status soon"><i class="fas fa-clock"></i> Soon</div>
    </div>
  </div>
</div>

@endsection