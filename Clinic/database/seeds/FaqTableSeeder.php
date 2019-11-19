<?php

use Illuminate\Database\Seeder;

class FaqTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faq')->insert([
            'question' => 'Quais as formas de pagamento?',
            'response' => 'Possibilitamos o pagamento dos serviços da Clínica das Horas através de multibanco, transferência bancária, cheque ou dinheiro, após o qual será emitido o respectivo recibo.'
         ]);
         DB::table('faq')->insert([
            'question' => 'Como consulto a tabela de preços e pagamentos?',
            'response' => 'Por favor solicite essa informação através dos nossos telefones ou por e-mail.'
         ]);
         DB::table('faq')->insert([
            'question' => 'A Clínica recebe pacientes com necessidades especiais?',
            'response' => 'Sim. Temos acessos para pacientes com mobilidade reduzida e, em caso de necessidade, basta solicitar a cadeira de rodas disponível na Clínica.'
         ]);

         DB::table('faq')->insert([
            'question' => 'A Clínica faz apoio domiciliário?',
            'response' => 'Disponibilizamos apoio domiciliário em situações de urgência, incapacidade comprovada ou necessidade grave que o justifique nas especialidades de Psicologia, Neurologia, Psiquiatria, Nutrição e Medicina Geral e Familiar.'
         ]);
         DB::table('faq')->insert([
            'question' => 'O que é a Psicoterapia',
            'response' => 'A psicoterapia é muito mais do que falar (desabafar) com alguém sobre determinados problemas ou dificuldades. É uma relação profissional entre um terapeuta e um cliente, tendo por base princípios e técnicas terapêuticas. '
         ]);

         DB::table('faq')->insert([
            'question' => 'O que fazer quando tenho um mau odor na vagina?',
            'response' => 'O procedimento a seguir é deitar azeite com um pouco de vinagre balsamico'
         ]);
    }
}
