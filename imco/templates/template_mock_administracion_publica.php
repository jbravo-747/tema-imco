<?php
/**
 * Template Mock: Datos de prueba para Administración Pública
 * 
 * Incluir en template_area_item.php para mostrar datos de ejemplo
 * en el entorno de desarrollo local cuando no hay datos reales.
 *
 * Uso: include_once('templates/template_mock_administracion_publica.php');
 *
 * @package WordPress - IMCO
 * @version DEV-ONLY
 */

// Datos de publicaciones de prueba
$mock_posts = array(
      array(
                'tipo'   => 'Artículo',
                'titulo' => 'Transparencia y rendición de cuentas en el gobierno federal 2025',
                'fecha'  => '20 Marzo, 2026',
                'autor'  => 'Ana González',
                'imagen' => 'https://picsum.photos/seed/admin1/480/300',
                'resumen'=> 'El IMCO analiza los avances y retrocesos en materia de transparencia gubernamental durante el último año fiscal.',
            ),
      array(
                'tipo'   => 'Investigación',
                'titulo' => 'Índice de Capacidad Institucional Municipal 2026',
                'fecha'  => '15 Marzo, 2026',
                'autor'  => 'Carlos Méndez',
                'imagen' => 'https://picsum.photos/seed/admin2/480/300',
                'resumen'=> 'Evaluación de 500 municipios en México en función de sus capacidades para implementar políticas públicas eficientes.',
            ),
      array(
                'tipo'   => 'Artículo',
                'titulo' => 'Anticorrupción: ¿Cuánto hemos avanzado?',
                'fecha'  => '10 Marzo, 2026',
                'autor'  => 'Laura Torres',
                'imagen' => 'https://picsum.photos/seed/admin3/480/300',
                'resumen'=> 'Revisión del Sistema Nacional Anticorrupción a cuatro años de su operación: logros, pendientes y perspectivas.',
            ),
      array(
                'tipo'   => 'Monitor',
                'titulo' => 'Desempeño del gasto público federal: primer trimestre 2026',
                'fecha'  => '5 Marzo, 2026',
                'autor'  => 'Ricardo Salinas',
                'imagen' => 'https://picsum.photos/seed/admin4/480/300',
                'resumen'=> 'Seguimiento puntual del ejercicio presupuestal del gobierno federal con indicadores clave de desempeño.',
            ),
  );

// Datos para gráficos de prueba
$mock_chart_data = array(
      'presupuesto' => array(
                'labels' => array('Educación','Salud','Seguridad','Infraestructura','Admin. Pública','Otros'),
                'valores' => array(28, 19, 15, 18, 12, 8),
                'colores' => array('#e63946','#457b9d','#2a9d8f','#e9c46a','#264653','#a8dadc'),
            ),
      'eficiencia' => array(
                'anios'   => array('2021','2022','2023','2024','2025'),
                'valores' => array(62, 65, 68, 71, 74),
            ),
  );
?>

<!-- =====================================================
     MOCK DATA: ADMINISTRACIÓN PÚBLICA (solo para DEV)
     ====================================================== -->
<div class="mock-data-banner" style="background:#fffbe6;border:2px dashed #f0b429;padding:10px 18px;margin:20px 0 10px;border-radius:6px;font-family:monospace;font-size:13px;color:#7a5200;">
    ⚠️ <strong>DATOS DE PRUEBA (DEV)</strong>strong> — Este bloque muestra contenido ficticio para desarrollo local. No aparece en producción.
</div>div>

<div id="mock-administracion-publica" style="padding: 0 20px;">

      <!-- === PUBLICACIONES DE PRUEBA === -->
      <div class="area_body_content_posts_title" style="margin-top:30px;">
                <h2>ÚLTIMAS PUBLICACIONES <span style="font-size:13px;color:#999;font-weight:normal;">(mock)</span>span></h2>h2>
      </div>div>

    <div class="mock-posts-list" style="margin-top:20px;">
              <?php foreach($mock_posts as $mp): ?>
          <div class="mock-post-item" style="display:flex;gap:24px;margin-bottom:32px;padding-bottom:28px;border-bottom:1px solid #e0e0e0;align-items:flex-start;">
                        <div class="mock-post-image" style="flex:0 0 200px;">
                                          <img src="<?php echo $mp['imagen']; ?>" alt="Imagen de prueba" style="width:200px;height:130px;object-fit:cover;border-radius:4px;">
                        </div>div>
                        <div class="mock-post-content" style="flex:1;">
                                          <span style="display:inline-block;background:#e63946;color:#fff;font-size:11px;font-weight:700;padding:3px 10px;border-radius:3px;text-transform:uppercase;margin-bottom:8px;">
                                                                <?php echo $mp['tipo']; ?>
                                          </span>span>
                                          <h3 style="margin:0 0 6px;font-size:18px;line-height:1.3;color:#222;">
                                                                <?php echo $mp['titulo']; ?>
                                          </h3>h3>
                                          <p style="font-size:13px;color:#666;margin:0 0 6px;">
                                                                <span style="margin-right:14px;">⏱ <?php echo $mp['fecha']; ?></span>span>
                                          </p>p>
                                          <a href="#" style="color:#e63946;font-weight:700;font-size:14px;text-decoration:none;">Ver más</a>a>
                                          <p style="font-size:13px;color:#555;margin:10px 0 0;">
                                                                <?php echo $mp['resumen']; ?>
                                          </p>p>
                                          <p style="font-size:13px;color:#888;margin:8px 0 0;">Autor: <?php echo $mp['autor']; ?></p>p>
                        </div>div>
          </div>div>
              <?php endforeach; ?>
    </div>div>

      <!-- === SECCIÓN DE GRÁFICOS DE PRUEBA === -->
      <div class="mock-charts-section" style="margin-top:40px;margin-bottom:40px;">
                <h2 style="font-size:20px;font-weight:700;text-transform:uppercase;border-bottom:3px solid #e63946;padding-bottom:8px;margin-bottom:24px;">
                              DATOS ESTADÍSTICOS <span style="font-size:13px;color:#999;font-weight:normal;">(mock)</span>span>
                </h2>h2>

                <div style="display:flex;gap:32px;flex-wrap:wrap;">

                              <!-- Gráfico 1: Dona - Distribución del gasto -->
                              <div style="flex:1;min-width:280px;background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:20px;">
                                                <h3 style="font-size:15px;font-weight:700;margin:0 0 16px;color:#333;">Distribución del Gasto Público (%)</h3>h3>
                                                <canvas id="mockChartDonut" width="280" height="220"></canvas>canvas>
                                                <p style="font-size:11px;color:#aaa;margin:10px 0 0;text-align:center;">Fuente: Datos ficticios para desarrollo</p>p>
                              </div>div>

                              <!-- Gráfico 2: Barras - Índice de eficiencia -->
                              <div style="flex:1;min-width:280px;background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:20px;">
                                                <h3 style="font-size:15px;font-weight:700;margin:0 0 16px;color:#333;">Índice de Eficiencia Gubernamental (2021–2025)</h3>h3>
                                                <canvas id="mockChartBar" width="280" height="220"></canvas>canvas>
                                                <p style="font-size:11px;color:#aaa;margin:10px 0 0;text-align:center;">Fuente: Datos ficticios para desarrollo</p>p>
                              </div>div>

                              <!-- Gráfico 3: Línea - Evolución de denuncias -->
                              <div style="flex:1;min-width:280px;background:#fff;border:1px solid #e0e0e0;border-radius:8px;padding:20px;">
                                                <h3 style="font-size:15px;font-weight:700;margin:0 0 16px;color:#333;">Denuncias Ciudadanas por Año</h3>h3>
                                                <canvas id="mockChartLine" width="280" height="220"></canvas>canvas>
                                                <p style="font-size:11px;color:#aaa;margin:10px 0 0;text-align:center;">Fuente: Datos ficticios para desarrollo</p>p>
                              </div>div>

                </div>div>
      </div>div>

      <!-- === BLOQUE DE TEXTO INFORMATIVO (mock) === -->
      <div class="mock-text-block" style="background:#f7f7f7;border-left:4px solid #e63946;padding:20px 24px;border-radius:4px;margin-bottom:40px;">
                <h3 style="font-size:16px;font-weight:700;margin:0 0 10px;color:#222;">Sobre Administración Pública – IMCO</h3>h3>
                <p style="font-size:14px;line-height:1.7;color:#444;margin:0;">
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit. El área de Administración Pública del IMCO se enfoca en analizar
                              las capacidades institucionales del sector público mexicano. Nuestros estudios abarcan temas como el presupuesto basado
                              en resultados, el servicio profesional de carrera, la arquitectura gubernamental, la transparencia y rendición de cuentas,
                              y las acciones anticorrupción a nivel federal, estatal y municipal.
                </p>p>
                <p style="font-size:14px;line-height:1.7;color:#444;margin:12px 0 0;">
                              Cras vehicula libero nec libero fermentum, at faucibus ante varius. Proin consequat arcu diam, vel vehicula felis dictum vel.
                              Integer posuere, turpis nec posuere sagittis, purus purus dignissim massa, sed efficitur enim quam id lorem. Quisque
                              fermentum diam vitae urna vestibulum, a bibendum est convallis.
                </p>p>
      </div>div>

      <!-- === INDICADORES RÁPIDOS (mock KPIs) === -->
      <div class="mock-kpis" style="display:flex;gap:20px;flex-wrap:wrap;margin-bottom:40px;">
                <div style="flex:1;min-width:140px;background:#e63946;color:#fff;border-radius:8px;padding:20px;text-align:center;">
                              <div style="font-size:36px;font-weight:900;line-height:1;">74</div>div>
                              <div style="font-size:12px;margin-top:6px;opacity:0.9;">Índice de Eficiencia</div>div>
                </div>div>
                <div style="flex:1;min-width:140px;background:#264653;color:#fff;border-radius:8px;padding:20px;text-align:center;">
                              <div style="font-size:36px;font-weight:900;line-height:1;">500</div>div>
                              <div style="font-size:12px;margin-top:6px;opacity:0.9;">Municipios evaluados</div>div>
                </div>div>
                <div style="flex:1;min-width:140px;background:#2a9d8f;color:#fff;border-radius:8px;padding:20px;text-align:center;">
                              <div style="font-size:36px;font-weight:900;line-height:1;">32</div>div>
                              <div style="font-size:12px;margin-top:6px;opacity:0.9;">Entidades federativas</div>div>
                </div>div>
                <div style="flex:1;min-width:140px;background:#457b9d;color:#fff;border-radius:8px;padding:20px;text-align:center;">
                              <div style="font-size:36px;font-weight:900;line-height:1;">12</div>div>
                              <div style="font-size:12px;margin-top:6px;opacity:0.9;">Publicaciones 2026</div>div>
                </div>div>
      </div>div>

</div>div>
<!-- /MOCK DATA -->

<!-- Chart.js para gráficos de prueba -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
  (function() {
        // Datos mock
        var presLabels = <?php echo json_encode($mock_chart_data['presupuesto']['labels']); ?>;
        var presValores = <?php echo json_encode($mock_chart_data['presupuesto']['valores']); ?>;
        var presColores = <?php echo json_encode($mock_chart_data['presupuesto']['colores']); ?>;
        var efAnios   = <?php echo json_encode($mock_chart_data['eficiencia']['anios']); ?>;
        var efValores = <?php echo json_encode($mock_chart_data['eficiencia']['valores']); ?>;

        // Gráfico Dona
        var ctxDonut = document.getElementById('mockChartDonut');
        if (ctxDonut) {
                  new Chart(ctxDonut, {
                                type: 'doughnut',
                                data: {
                                                  labels: presLabels,
                                                  datasets: [{ data: presValores, backgroundColor: presColores, borderWidth: 2 }]
                                },
                                options: {
                                                  responsive: true,
                                                  plugins: { legend: { position: 'bottom', labels: { font: { size: 11 } } } }
                                }
                  });
        }

        // Gráfico Barras
        var ctxBar = document.getElementById('mockChartBar');
        if (ctxBar) {
                  new Chart(ctxBar, {
                                type: 'bar',
                                data: {
                                                  labels: efAnios,
                                                  datasets: [{
                                                                        label: 'Índice de eficiencia',
                                                                        data: efValores,
                                                                        backgroundColor: '#e63946',
                                                                        borderRadius: 4
                                                  }]
                                },
                                options: {
                                                  responsive: true,
                                                  scales: {
                                                                        y: { beginAtZero: false, min: 55, max: 85, ticks: { font: { size: 11 } } },
                                                                        x: { ticks: { font: { size: 11 } } }
                                                  },
                                                  plugins: { legend: { display: false } }
                                }
                  });
        }

        // Gráfico Línea
        var ctxLine = document.getElementById('mockChartLine');
        if (ctxLine) {
                  new Chart(ctxLine, {
                                type: 'line',
                                data: {
                                                  labels: efAnios,
                                                  datasets: [{
                                                                        label: 'Denuncias ciudadanas (miles)',
                                                                        data: [42, 51, 58, 63, 70],
                                                                        borderColor: '#264653',
                                                                        backgroundColor: 'rgba(38,70,83,0.12)',
                                                                        borderWidth: 2,
                                                                        tension: 0.3,
                                                                        fill: true,
                                                                        pointRadius: 5,
                                                                        pointBackgroundColor: '#264653'
                                                  }]
                                },
                                options: {
                                                  responsive: true,
                                                  scales: {
                                                                        y: { beginAtZero: false, min: 30, ticks: { font: { size: 11 } } },
                                                                        x: { ticks: { font: { size: 11 } } }
                                                  },
                                                  plugins: { legend: { display: false } }
                                }
                  });
        }
  })();
</script>
</script>
    </h2>
</strong>
